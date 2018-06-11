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
        <b-form-group horizontal label="Ordenar" class="mb-0">
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
         <b-btn v-b-modal.agregar variant="primary">Agregar Nueva Sucursal</b-btn>
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
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc"
             @filtered="onFiltered"
    >
     
    <!--   <template slot="Origen" slot-scope="row">{{row.value.nombre}}</template>
      <template slot="Destino" slot-scope="row">{{row.value.nombre}}</template> -->
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
        <b-button size="sm" @click.stop="info(row.item,row.item, row.index, $event.target)" class="mr-1" variant="primary">
          Modificar
        </b-button>
        <div v-if="row.item.Status == 'activa'">
          <b-button size="sm" @click.stop="Deshabilitar(row)">            
            Deshabilitar
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
    <b-modal ref="myModalRef" id="modalInfo" @hide="resetModal"  hide-footer>
      <div v-if="modalInfo.content != ''">
        <b-form @submit.prevent="actualizar()">       
         
       <div class="row">
        
         <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Nombre: </b></label>
              <b-form-input id="distancia"
                      type="text"
                      required
                      v-model="modalInfo.content.Nombre"
                      placeholder="Inserte Matricula">
              </b-form-input>
            </div>
          
          <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Sigla: </b></label>
              <b-form-input id="tarifa"
                      type="text"
                      required
                      v-model="modalInfo.content.Sigla"
                      placeholder="Inserte  Modelo">
              </b-form-input>
            </div>
          
           <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Ciudad: </b></label>
              <b-form-input id="tarifa"
                      type="text"
                      required
                      v-model="modalInfo.content.Ciudad"
                      placeholder="Inserte  Modelo">
              </b-form-input>
            </div>

            
        
        </div>
    
     
     
      <div class="text-center">
        <b-button type="submit" variant="primary" >Actualizar</b-button>
      </div>
      
    </b-form>
    </div>
     
    </b-modal>

    <!-- AGREGAR -->
     <RegistrarSucursal> </RegistrarSucursal>

  </b-container>
</template>

<script>

import axios  from 'axios';
import RegistrarSucursal from './RegistrarSucursal';
import {EventBus} from './event-bus.js'


export default {
  components: {
    RegistrarSucursal
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
      
        { key: 'Nombre',    label: 'Nombre',  sortable: true },
        { key: 'Sigla',   label: 'Siglas', sortable: true },
        { key: 'Ciudad', label: 'Ciudad', sortable: true },
        { key: 'Status',    label: 'Estatus', sortable: true},       
        
    
        { key: 'actions',   label: '  ', 'class' : 'text-center' }
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
      axios.get("/sucursales/all").then(function(response){
        // console.log(response.data);
        ctx.data = response.data;
        console.log(ctx.data);
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
          Nombre: this.data[i].nombre,
          Sigla: this.data[i].sigla,
          Ciudad: this.data[i].ciudad,
          Status: this.data[i].estatus,
          id: this.data[i].sucursal_id,
          
        });
      }
     
    },
    actualizar(){
     
      axios({
        method: 'post',
        url: '/sucursales/sucursales',
        data: {
          id: this.modalInfo.content.id,  
          Nombre: this.modalInfo.content.Nombre,    
          Sigla: this.modalInfo.content.Sigla, 
          Ciudad: this.modalInfo.content.Ciudad,
        }
      }).then((response) =>{
        console.log(response.data);
       Vue.toasted.show(response.data, {
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
        url: '/sucursales/deshabilitar',
        data: {
          id: row.item.id,               
        }
      }).then((response)=>{
       
       Vue.toasted.show(response.data, {
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
        url: '/sucursales/habilitar',
        data: {
          id: row.item.id,               
        }
      }).then((response)=>{
      
      Vue.toasted.show(response.data, {
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
    },
    sumar(experiencias){
      var horas= 0;
      var minutos = 0;
      var segundos = 0;
      for(var i = 0; i < experiencias.length; i++){
        horas += parseInt(experiencias[i].horas.split(':')[0]);
        minutos += parseInt(experiencias[i].horas.split(':')[1]);
        segundos += parseInt(experiencias[i].horas.split(':')[2]);        
      }
      if(segundos % 60){
        minutos += parseInt(segundos / 60); 
        segundos = segundos % 60;       
      }
      if(minutos % 60){
        horas += parseInt(minutos / 60);
        minutos = minutos % 60;
      }
      if(horas < 9)
        horas = "0"+horas;
      if(minutos < 9)
        minutos = "0"+minutos;
      if(segundos < 9)
        segundos = "0" + segundos;
      return horas + ":" + minutos + ":" + segundos;
    }
  }
}
</script>

<!-- table-complete-1.vue -->



