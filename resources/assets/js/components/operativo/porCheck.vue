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
      <p></p>
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
             @filtered="onFiltered"
    >
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
          <div v-if="row.item.estatus != 'Chequeado'">
          <b-button size="sm" class="btn btn-warning btn-sm" @click.stop="info(row.item, row.index, $event.target)" variant="success">
           Check-In
          </b-button>
          </div>
          <div v-else>
          <b-button size="sm" disabled="disabled" variant="primary">
            Chequeado
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
   
    <!-- Modal Registrar -->
    <b-modal ref="myModalRef" id="modalInfo" @hide="resetModal" :title="modalInfo.title"  hide-footer>  
      
     <div v-if="modalInfo.content != ''">
    <b-form @submit.prevent="addMaletas()">
        
      <div class="row"><p></p></div><!--  espacio -->
      
      <div class="row text-center">
        <label for="equipaje">Cantidad de Equipaje: </label>
        <div class="col-sm-4">
            <b-form-input id="equipaje"
                          type="number"
                          min="0"
                          max="4"
                          v-on:change=sobrepeso()
                          v-model="form.equipaje">
            </b-form-input>
          </div>
      </div>
      <div class="row"><p></p></div><!--  espacio -->
      <div class="row text-center">
       <label for="peso">Inserte  El peso total:        </label>
        <div class="col-sm-4">
           <b-input-group append="kgrs">
            <b-form-input id="peso"
                          type="number"
                          min="0"
                          max="25"
                          v-on:change=sobrepeso()
                          v-model="form.peso">
            </b-form-input>
           </b-input-group>
          </div>
      </div>
      <div class="row"><p></p></div><!--  espacio -->
      <div class="row text-center">
         <label for="sobrepeso" >Tarifa a pagar por SobrePeso: {{ form.sobrepeso }} BsS   </label>

     
    </div>
   <div class="row"><p></p><p></p></div><!--  espacio -->
   <div id='search-results' class="col-sm-6">
         <label for="asiento" >Seleccione el Asiento:   </label>
          
         <multiselect v-model="form.puesto" :options="puestos" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar" deselectLabel="Eliminar" required></multiselect>

    </div> 
    <div class="row"><p></p><p></p></div><!--  espacio -->
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
import multiselect from 'vue-multiselect'
import {EventBus} from './event-bus.js'

export default {
  created: function(){
    EventBus.$on('actualizartabla',(event) =>{
      this.Cargadatos(this);
     });
    this.Cargadatos(this)

  },
   components: {
            multiselect
        },
   data () {
    return {
      items: null,
      data: null,
      fields: [
      
        { key: 'n_vuelo',    label: 'Vuelo',  sortable: true },
        { key: 'cedula', label: 'Cedula ', sortable: true},
        { key: 'pasajero', label: 'Nombre Pasajero ', sortable: true},
        { key: 'localizador',   label: 'Localizador de Boleto', sortable: true },
        { key: 'actions',   label: ' - ', 'class' : 'text-center' },
      
        
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      filter: null,
      modalInfo: { title: '', content: '' },
      form: {equipaje: '0', peso:'0', puesto:'', id:'',sobrepeso:'0'},
      puestos: [] 
    }
  },

  
  methods: {
      info (item, index, button) {
      this.modalInfo.content = item; 
      var n_v=JSON.stringify(item.n_vuelo);
      axios({
            method: 'post',
            url: '/check/asientosAsignados',
            data:{'vuelo':n_v},
           }).then((response) => {
             this.puestos=response.data;
           }).catch((err)=>{
        console.log("error al traer al axios de puestos");
        console.log(err);
      });
    
      this.modalInfo.title = "Vuelo: "+item.n_vuelo+" Pasajero: "+item.pasajero;     
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
      axios.get("/check/check").then(function(response){
        // console.log(response.data);
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
          id: this.data[i].id,
          n_vuelo: this.data[i].codvuelos,
          pasajero:this.data[i].pasajero,
          nombreCompleto:this.data[i].nombre_pasajero,
          cedula:this.data[i].documento,
          origen:{
             nombre:this.data[i].origen,
             sigla:this.data[i].sigla_destino,
             aeropuerto:this.data[i].aeropuerto_origen
            },
          destino:{
             nombre:this.data[i].destino,
             sigla:this.data[i].sigla_destino,
             aeropuerto:this.data[i].aeropuerto_destino
            },
          estatus:this.data[i].estatus,
          localizador:this.data[i].localizador,
          tarifa:this.data[i].tarifa_vuelo
        });
      }
     
    },
    addMaletas(){
               this.form.id=this.modalInfo.content.id;
               axios({
                method: 'post',
                url: '/check/maletas',
                data: this.form,
               }).then((response)=>{
                Vue.toasted.show(response.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                });
                EventBus.$emit('actualizartabla',true);
                this.$root.$emit('bv::hide::modal', 'modalInfo', '#app');
               }).catch((err) =>{

               });
           },
    sobrepeso(){
      var precioS=0
      if(this.form.peso>25){
        this.form.peso=25;
      }
      if(this.form.equipaje>4){
        this.form.equipaje=4;
      }
      if(this.form.peso>23){
        var peso = this.form.peso-23
        var precio = this.modalInfo.content.tarifa*0.01
         precioS =peso*precio
      }
      this.form.sobrepeso=precioS;
    },
    chekear(row){
     this.$dialog.confirm('Esta opcion no puede ser revertida')
	    .then(function () {
              axios({
                  method: 'post',
                  url: '/check/check/chekear',
                  data: {
                    id: row.item.id,               
                  }
                }).then((response)=>{
                
                Vue.toasted.show(response.data, {
                  theme: "primary", 
                  position: "bottom-right",
                    duration : 2000
                });
                 EventBus.$emit('actualizartabla',true);
               // this.Cargadatos(this);

                }).catch((err)=>{
                  Vue.toasted.show("Boleto Check-In incorrecto"+err, {
                    theme: "primary",  
                  position: "bottom-right",
                    duration : 2000
                });
                });
                //fin axios
        })
	      .catch(function () {
		    console.log('Cancelar esta Operacion')
	       });
    } 
  }
} 
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"> </style>


