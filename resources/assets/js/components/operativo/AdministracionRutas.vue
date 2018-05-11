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
        <b-form-group horizontal label="Sort" class="mb-0">
          <b-input-group>
            <b-form-select v-model="sortBy" :options="sortOptions">
              <option slot="first" :value="null">-- ninguno --</option>
            </b-form-select>
            <b-form-select :disabled="!sortBy" v-model="sortDesc" slot="append">
              <option :value="false">Asc</option>
              <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>
      <b-col md="6" class="my-1">
         <b-btn v-b-modal.agregar variant="primary">Agregar Nueva Ruta</b-btn>
      </b-col>
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Per page" class="mb-0">
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
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc"
             @filtered="onFiltered"
    >
     
      <template slot="Origen" slot-scope="row">{{row.value.nombre}}</template>
      <template slot="Destino" slot-scope="row">{{row.value.nombre}}</template>
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
        <b-button size="sm" @click.stop="info(row.item,row.item, row.index, $event.target)" class="mr-1" variant="primary">
          Modificar
        </b-button>
        <div v-if="row.item.Estado == 'activo'">
          <b-button size="sm" @click.stop="Deshabilitar(row)">
            
            Desabilitar
          </b-button>
        </div>
        <div v-else>
          <b-button size="sm" @click.stop="Habilitar(row)" variant="success">
            
            Habilitar
          </b-button>
        </div>
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
       <!--    <pre>{{modalInfo.content}}</pre>-->
       <div class="row">
          <div class="form-group col-sm-1 "></div>
          <div class="col-sm-5">
            <label for="distancia"> <b> Inserte Nueva Distancia: </b></label>
            <b-form-input id="distancia"
                      type="text"
                      required
                      v-model="modalInfo.content.Distancia"
                      placeholder="Inserte Nueva Distancia">
            </b-form-input>
          </div>
          
         <div class="col-sm-5">
           <label for="distancia"> <b> Inserte Nueva Tarifa: </b></label>
            <b-form-input id="tarifa"
                          type="text"
                          required
                          v-model="modalInfo.content.Tarifa"
                          placeholder="Inserte Nueva Tarifa">
            </b-form-input>
          </div>
           <div class="form-group col-sm-1 "></div>
        </div>
      <div class="row"><p></p></div>
      <div class="row text-center"><div class="col-sm-12 " ><label for="duracion" class="text-center"> <b> Tiempo de Vuelo: </b> </label></div></div>   
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
     
    </div>
      <div class="text-center">
        <b-button type="submit" variant="primary" >Actualizar</b-button>
      </div>
      
    </b-form>
    </div>
     
    </b-modal>

    <!-- AGREGAR -->
     <RegistrarRutas> </RegistrarRutas>

  </b-container>
</template>

<script>

import axios  from 'axios';
import RegistrarRutas from './ModalRegistrar';
import {EventBus} from './event-bus.js'


export default {
  components: {
    RegistrarRutas
  },
  created: function(){
    EventBus.$on('actualizartabla',(event) =>{
      alert("prueba pipe");
      this.Cargadatos(this);
    });
    this.Cargadatos(this)

  },
  data () {
    return {
      items: null,
      data: null,
      fields: [
      
        { key: 'Origen',    label: 'Sucursal de Origen',  sortable: true },
        { key: 'Destino',   label: 'Sucursal de Destino', sortable: true },
        { key: 'Distancia', label: 'Distancias ', sortable: true },
        { key: 'Duracion',  label: 'Duracion ',  sortable: true },
        { key: 'Tarifa',    label: 'Tarifa ', sortable: true },
        { key: 'Estado',    label: 'Estado', sortable: true},
        { key: 'actions',   label: ' - ', 'class' : 'text-center' }
      ],
      duracionModel: {
        HH : '',
        mm : '',
        ss : ''
      },
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      sortBy: null,
      sortDesc: false,
      filter: null,
      modalInfo: { title: '', content: '' },
      estados:['activo','inactivo']
    }
  },
  computed: {
    sortOptions () {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => { return { text: f.label, value: f.key } })
    }
  },
  methods: {
    info (item, index, button) {
      this.modalInfo.content = item;
      this.modalInfo.title = item.Origen.nombre + " - " + item.Destino.nombre;
      var elementos = item.Duracion.split(':')
     
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
      axios.get("/rutas/rutas").then(function(response){
        console.log(response.data);
        ctx.data = response.data;
        ctx.formatodatos();
        ctx.totalRows=ctx.items.length;
      }).catch((err)=>{
        console.log("err");
        console.log(err);
      });
    },
    formatodatos(){
      this.items = [];
      for (var i= 0; i < this.data.length; i++){
        this.items.push({
          id: this.data[i].ruta.id,
          Origen: {
            id: this.data[i].ruta.origen.id,
            nombre: this.data[i].ruta.origen.nombre
          },
          Destino: {
            id: this.data[i].ruta.destino.id,
            nombre: this.data[i].ruta.destino.nombre
          },
          Distancia:this.data[i].ruta.distancia,
			  	Duracion:this.data[i].ruta.duracion,
          Tarifa:this.data[i].ruta.tarifa_vuelo,
          Estado:this.data[i].ruta.estado,
        });
      }
      console.log('entre');
      console.log(this.items);
    },
    actualizar(){
      this.modalInfo.content.Duracion=this.duracionModel.HH+':'+ this.duracionModel.mm+':'+ this.duracionModel.ss;
      axios({
        method: 'post',
        url: '/rutas/rutas',
        data: {
          id: this.modalInfo.content.id,
          Origen: this.modalInfo.content.Origen,
          Destino: this.modalInfo.content.Origen,
          Distancia: this.modalInfo.content.Distancia,
          Tarifa: this.modalInfo.content.Tarifa,
          Estado: this.modalInfo.content.Estado,
          Duracion:  this.modalInfo.content.Duracion      
        }
      }).then((response) =>{
       Vue.toasted.show('Se ha guardado existosamente la informacion', {
           theme: "primary", 
	       position: "bottom-right",
	        duration : 2000
       });
       //this.$refs.myModalRef.hide();
       this.$root.$emit('bv::hide::modal', 'modalInfo', '#app');

      }).catch((err)=>{
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
        console.log(response);
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



