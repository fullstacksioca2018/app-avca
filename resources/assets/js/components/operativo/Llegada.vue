<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Filtro" class="mb-0">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Escriba para buscar" />
            <b-input-group-append>
              <b-btn :disabled="!filter" @click="filter = ''">Limpiar</b-btn>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
      
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Por Página" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
             @filtered="onFiltered">
     
      <template slot="Ruta" slot-scope="row"> [{{row.value.Origen.sigla}}] - [{{row.value.Destino.sigla}}]</template>
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
        <b-button size="sm" @click.stop="info(row.item,row.item, row.index, $event.target)" class="mr-1" variant="primary">
          Modificar
        </b-button>
        </b-input-group>
      </template>
      <template slot="row-details" slot-scope="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
          </ul>
        </b-card>
      </template>
    </b-table>
    <b-col class="col-md-12 ">
      <b-pagination  align="center" :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
    </b-col>

    
    <!-- Modal Actualizar -->
    <b-modal ref="myModalRef" id="modalInfo" @hide="resetModal" :title="modalInfo.title"  hide-footer>
    <div v-if="modalInfo.content != ''">
    <b-form @submit.prevent="actualizar()">
          <!--  <pre>{{modalInfo.content}}</pre> -->
       <div class="row"><p></p></div>
      <div class="row text-center"><div class="col-sm-12 " ><label for="duracion" class="text-center"> <b> Registre Hora de Legada del Vuelo: </b> </label></div></div>   
      <div class="row col-sm-12 " id="duracion">
      <div class="form-group col-sm-2 "></div>
      <div class="col-sm-3 ">
      <span class="help-block"> Horas </span>
      <b-form-input type="number" min="0" max="24" class="form-control" id="ccyear" v-model="duracionModel.HH"></b-form-input> 
      
      </div>
     
      <div class="form-group col-sm-3 ">
        <span class="help-block"> Minutos </span>
        <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" v-model="duracionModel.mm"></b-form-input>
      </div>
       
      <div class="form-group col-sm-3 ">
        <span class="help-block"> Segundos </span>
        <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" v-model="duracionModel.ss"></b-form-input>
      </div>
      <div class="row"><p></p></div>
      <div class="row text-center"><div class="col-sm-8 offset-2 " ></div></div>
      <div class="row col-sm-8 offset-2 ">
        <label for="observaciones" class="text-center"> <b> Registre Observaciones del Vuelo: </b> </label>
        <b-form-textarea id="observaciones"
                         :rows="3"
                         :max-rows="6"
                          required
                          v-model="duracionModel.area"
                          placeholder="Observaciones...">
            </b-form-textarea>
      </div>
     
    </div>
    <div class="row"><p></p></div>
      <div class="text-center">
        <b-button type="submit" variant="primary" >Actualizar</b-button>
      </div> 
      
    </b-form>
    </div>
     
    </b-modal>


  </b-container>
</template>

<script>

import axios  from 'axios';
import moment,{ now } from 'moment';
import {EventBus} from './event-bus.js'


export default {
  components: {
    moment
  },
  created: function(){
    EventBus.$on('actualizartabla',(event) =>{
      this.Cargadatos(this);
    });
    this.Cargadatos(this)

  },
  data () {
    return {
      items: null,
      data: null,
      fields: [
      
        { key: 'Ruta',    label: 'Origen - Destino',  sortable: true },
        { key: 'Fecha',     label: 'Fecha', sortable: true },
        { key: 'Hora'  ,    label: 'Hora Salida ', sortable: true },
        { key: 'Duracion',  label: 'Duracion',  sortable: true },
        { key: 'Llegada',   label: 'Llegada ', sortable: true },        
        { key: 'Estado',    label: 'Estatus', sortable: true},
        { key: 'actions',   label: ' - ', 'class' : 'text-center' }
      ],
      duracionModel: {
        HH : '',
        mm : '',
        ss : '',
        area: '',
        id: ''
      },
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      filter: null,
      modalInfo: { title: '', content: '' },
    }
  },
  computed: {
  },
  methods: {
    info (item, index, button) {
      this.modalInfo.content = item;
      this.modalInfo.title = item.n_vuelo+"   "+item.Fecha+" - "+item.Hora;
      var fecha = item.Llegada.split(' ');
      var elementos = fecha[1].split(':');
     
      this.duracionModel.HH = elementos[0]
      this.duracionModel.mm = elementos[1]
      this.duracionModel.ss = elementos[2]
      
      this.$root.$emit('bv::show::modal', 'modalInfo', button)
    },
   
    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
    Cargadatos(ctx){
      axios.get("/llegada/llegadas").then(function(response){
        // console.log(response.data);
        ctx.data = response.data;
        ctx.formatodatos();
        ctx.totalRows=ctx.items.length;
      }).catch((err)=>{
        console.log("error en axios get llegada/llegas ");
        console.log(err);
      });
    },
    formatodatos(){
      this.items = [];
      //var now = moment().format('d-m-YYYY');
      for (var i= 0; i < this.data.length; i++){
        var elementos=this.data[i].fecha_salida.split(' ');
        // parseando hora de salida y la duracion para calcular la hora de llegada
        var fecha = moment(elementos[0]).format('DD-MM-YYYY');
        var hora=elementos[1].split(':');
        var HH=parseInt(hora[0]);
        var mm=parseInt(hora[1]);
        var ss=parseInt(hora[2]);
        var duracion2=this.data[i].segmentos[0].ruta.duracion.split(':');
        var HH2=parseInt(duracion2[0]);
        var mm2=parseInt(duracion2[1]);
        var ss2=parseInt(duracion2[2]);
        //empezar a sumar las dos horas para 
        var HH3=HH+HH2;
        var mm3=mm+mm2;
        var ss3=ss+ss2;
        //comprar las sumas si ss >59 colocar en 0 y asi sucesivamente.
        while(ss3>59)//segundos
        {
          ss3=ss3-60;
          mm3=mm3+1;

        }
        if(ss3<10){ss3="0"+ss3}
    
        while(mm3>59)//minutos
        {
          mm3=mm3-60;
          HH3=HH3+1;

        }
        if(mm3<10){mm3="0"+mm3}
          
        while(HH3>59)//Horas
        {
          HH3=HH3-60;
          fecha = moment(elementos[0]).add(1,'days').format('DD-MM-YYYY');
        }
        if(HH3<10){HH3="0"+HH3} 
        
        this.items.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Llegada:fecha+" "+HH3+":"+mm3+":"+ss3, 
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          aeronave: this.data[i].segmentos[0].aeronave_id,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
      }
     
    },
    actualizar(){
      this.duracionModel.id=this.modalInfo.content.id;
      var datos= JSON.stringify(this.duracionModel);
      axios({
        method: 'post',
        url: '/llegada/llego',
        data: { 'datos': datos}
      }).then((response) =>{
        console.log(response.data);
       Vue.toasted.show('El vuelo ha llegado exitosamente', {
           theme: "primary", 
	       position: "bottom-right",
	        duration : 2000
       });
       //this.$refs.myModalRef.hide();
       this.$root.$emit('bv::hide::modal', 'modalInfo', '#app');

      }).catch((err)=>{
        console.log(err);
         Vue.toasted.show('Ha ocurrido un error', {
         theme: "primary", 
	      position: "bottom-right",  
	        duration : 2000
       });
        console.log(err);
      });
    },
    Deshabilitar(row){
     axios({
        method: 'post',
        url: '/rutas/rutas/deshabilitar',
        data: {
          id: row.item.id,               
        }
      }).then((response)=>{
       
       Vue.toasted.show("Ruta Deshabilitada", {
          theme: "primary", 
	      position: "bottom-right",
	        duration : 2000
       });
       this.Cargadatos(this);

      }).catch((err)=>{
        console.log(err);
       });
    },
    Habilitar(row){
     axios({
        method: 'post',
        url: '/rutas/rutas/habilitar',
        data: {
          id: row.item.id,               
        }
      }).then((response)=>{
      
      Vue.toasted.show("Ruta Habilitada", {
         theme: "primary", 
	       position: "bottom-right",
	        duration : 2000
       });
       this.Cargadatos(this);

      }).catch((err)=>{
        Vue.toasted.show(err, {
          theme: "primary",  
	      position: "bottom-right",
	        duration : 2000
       });
       });
    }
  }
}
</script>

<!-- table-complete-1.vue -->
