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
         <b-btn v-b-modal.agregar variant="primary">Agregar Nuevo Vuelo</b-btn>
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
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
        <b-button size="sm" @click.stop="info(row.item, row.index, $event.target)" class="mr-1" variant="primary">
          Ver
        </b-button>
        <div v-if="row.item.Estado == 'abierto'">
          <b-button size="sm" @click.stop="Deshabilitar(row)">
            Cancelar
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
          <ul >
            <li  v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
           
          </ul>
        </b-card>
      </template>
    </b-table>
    <b-col class="col-md-12 ">
      <b-pagination  align="center" :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
    </b-col>

    
    <!-- Modal Actualizar -->
    <b-modal  ref="myModalRef" size="lg" id="modalInfo" @hide="resetModal" :title="modalInfo.title"  hide-footer>
    <div v-if="modalInfo.content != ''">
    <b-form @submit.prevent="ver()">
      
        <b-tabs pills card>
    <b-tab title="Vuelo" active>
      Vuelo
    </b-tab>
    <b-tab title="Tripulante">
     Tripulantes
    </b-tab>
   
  </b-tabs>

      
    </b-form>
    </div>
     
    </b-modal>

    <!-- AGREGAR -->
              <RegistrarVuelos> </RegistrarVuelos>
    
  </b-container>
</template>

<script>

import axios  from 'axios';
import RegistrarVuelos from './ModalRegistrarVuelos';
import {EventBus} from './event-bus.js'


export default {
  components: {
    RegistrarVuelos
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
        { key: 'N_Vuelo',    label: 'Numero de Vuelo',  sortable: true },
        { key: 'Ruta',   label: 'Siglas', sortable: true },
        { key: 'Fecha', label: 'Fecha ', sortable: true },
        { key: 'Hora',  label: 'Hora ',  sortable: true },
        { key: 'Estado',    label: 'Estado ', sortable: true },
        { key: 'actions',   label: ' - ', 'class' : 'text-center' }
      ],      
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      sortBy: null,
      sortDesc: false,
      filter: null,
      modalInfo: { title: '', content: '' }
      
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
      this.modalInfo.title = "Datos del Vuelo: " + item.N_Vuelo;
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
      axios.get("/vuelos/vuelos").then(function(response){
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
         //var elementos=this.data[i].fecha_salida.split(' ')
         console.log('valor de iten en'+i+'es '+JSON.stringify(this.data[i]))
  
        if(this.data[i].vuelo.segmentos.length == 0){
         /*  this.items.push({
            N_Vuelo: this.data[i].vuelo.n_vuelo,
            Ruta: "Ruta no Definida",
            Fecha: this.data[i].vuelo.fecha_salida,
            Hora: this.data[i].vuelo.fecha_salida,
            Estado: this.data[i].vuelo.estado     
          }); */
        }
        else{
          if( this.data[i].vuelo.estado == "abierto"){    
            var rutas = "";
            for(var j = 0; j < this.data[i].vuelo.segmentos.length; j++){
              rutas += "[" + this.data[i].vuelo.segmentos[j].ruta.sigla + "] ";
            }
            var fecha = this.data[i].vuelo.fecha_salida.split(" ")[0];
            var hora = this.data[i].vuelo.fecha_salida.split(" ")[1];
            this.items.push({
              N_Vuelo: this.data[i].vuelo.n_vuelo,
              Ruta: rutas,
              Fecha: fecha,
              Hora: hora,
              Estado: this.data[i].vuelo.estado     
            });
          }
        }
        
         
         
      }
    },
    actualizar(){
      axios({
        method: 'post',
        url: '/rutas/rutas',
        data: {
          N_Vuelos: this.modalInfo.content.N_Vuelos,
         Ruta: this.modalInfo.content.segmentos.ruta.sigla,
         Fecha: this.modalInfo.content.fecha_salida,
         Hora: this.modalInfo.content.fecha_salida,
         Estado: this.modalInfo.content.estado 
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
        url: '/vuelos/vuelos/deshabilitar',
        data: {
          id: row.item.id,               
        }
      }).then((response)=>{
       Vue.toasted.show("Vuelo Deshabilitado", {
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
        url: '/vuelos/vuelos/habilitar',
        data: {
          id: row.item.id,               
        }
      }).then((response)=>{
        console.log(response);
      Vue.toasted.show("Vuelo Habilitado", {
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



