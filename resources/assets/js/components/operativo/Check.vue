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
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc"
             @filtered="onFiltered"
    >
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
          <div v-if="row.item.estatus != 'Chequeado'">
          <b-button size="sm" class="btn btn-warning btn-sm" @click.stop="chekear(row)" variant="success">
            Check-In
          </b-button>
          </div>
          <div v-else>
          <b-button size="sm" disabled="disabled" variant="primary">
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

    
    <!-- Modal cargar maletas -->
    <b-modal ref="myModalRef" id="modalInfo" @hide="resetModal" :title="modalInfo.title"  hide-footer>
    <div v-if="modalInfo.content != ''">
    <b-form @submit.prevent="actualizar()">
       <!--    <pre>{{modalInfo.content}}</pre>-->
       <div class="row">
          <div class="form-group col-sm-1 "></div>
          <div class="col-sm-5">
            <label for="distancia"> <b> Inserte Distancia: </b></label>
            <b-form-input id="distancia"
                      type="text"
                      required
                      v-model="modalInfo.content.Distancia"
                      placeholder="Inserte Distancia">
            </b-form-input>
          </div>
          
         <div class="col-sm-5">
           <label for="distancia"> <b> Inserte Tarifa: </b></label>
            <b-form-input id="tarifa"
                          type="text"
                          required
                          v-model="modalInfo.content.Tarifa"
                          placeholder="Inserte  Tarifa">
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

  </b-container>
</template>

<script>

import axios  from 'axios';
import {EventBus} from './event-bus.js'


export default {
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
      
        { key: 'n_vuelo',    label: 'Vuelo',  sortable: true },
        { key: 'cedula', label: 'Cedula ', sortable: true},
        { key: 'pasajero', label: 'Nombre Pasajero ', sortable: true},
        { key: 'localizador',   label: 'Localizador de Boleto', sortable: true },
        { key: 'actions',   label: ' - ', 'class' : 'text-center' }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
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
      /* this.modalInfo.title = item.Origen.nombre + " - " + item.Destino.nombre;
      var elementos = item.Duracion.split(':')
     
      this.duracionModel.HH = elementos[0]
      this.duracionModel.mm = elementos[1]
      this.duracionModel.ss = elementos[2] */
      
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
          localizador:this.data[i].localizador
        });
      }
     
    },
    actualizar(){
      axios({
        method: 'post',
        url: '/check/check',
        data: {
          id: this.modalInfo.content.id,
          n_vuelo: this.modalInfo.n_vuelo,
          pasajero: this.modalInfo.pasajero,
          nombreCompleto: this.modalInfo.nombreCompleto,
          cedula: this.modalInfo.cedula,
          origen: this.modalInfo.content.origen,
          destino: this.modalInfo.content.destino,
          Distancia: this.modalInfo.content.Distancia,
          estatus: this.modalInfo.content.estatus,
          localizador:  this.modalInfo.content.localizador      
        }
      }).then((response) =>{
        console.log(response.data);
       Vue.toasted.show('Se ha guardado exitosamente la informacion', {
           theme: "primary", 
	       position: "bottom-right",
	        duration : 2000
       });
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

<!-- table-complete-1.vue -->