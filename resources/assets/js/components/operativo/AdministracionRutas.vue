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
        <b-form-group horizontal label="Organizar por" class="mb-0">
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
      <b-col md="6" class="my-1" >
             <b-btn v-b-modal.modalPrevent>Agregar Nueva Ruta</b-btn>
      </b-col>
      <!-- Centrar -->
   
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Por Página" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
    </b-row>
    

    <!-- Main table element -->
    <div v-if="items != null">
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
        <b-button size="sm" @click.stop="info(row.item.Destino.id, row.index, $event.target)" class="mr-1">
          Modificar
        </b-button>
        <b-button size="sm" @click.stop="row.toggleDetails">
         Eliminar
        </b-button>
      </template>
      <template slot="row-details" slot-scope="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
          </ul>
        </b-card>
      </template>
    </b-table>
    <!-- Centrar -->
    <b-col md="12" class="my-1" >
        <b-pagination align="center" :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
    </div>

    <!-- Info modal -->
    <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.content }}</pre>      
    </b-modal>

    <b-modal id="addInfo" @hide="addInfo" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.content }}</pre>      
    </b-modal>

    <b-modal id="modalPrevent"
             ref="modal"
             title="Registrar Ruta"
             @ok="handleOk"
             @shown="clearName">
      <form @submit.stop.prevent="handleSubmit">
       <b-container class="bv-example-row">
    <b-row>
        <b-col><multiselect  v-model="select" :options="options"></multiselect></b-col>
        <b-col><multiselect  v-model="select" :options="options"></multiselect></b-col>
      
                       

       
        
    </b-row>
    <b-row>
        <b-col>1 of 3</b-col>
        <b-col>2 of 3</b-col>
        <b-col>3 of 3</b-col>
    </b-row>
</b-container>

        
      </form>
    </b-modal>

  </b-container>
</template>

<script>

import axios  from 'axios';
import multiselect from 'vue-multiselect';

export default {
  components: {
    multiselect
  },
  data () {
    return {
      items: null,
      data: null,
      selected : null,
      options: ['list', 'of', 'options'],
      fields: [
        { key: 'Origen',    label: 'Sucursal de Origen',  sortable: true },
        { key: 'Destino',   label: 'Sucursal de Destino', sortable: true },
        { key: 'Distancia', label: 'Distancias ', sortable: true },
        { key: 'Duracion',  label: 'Duracion ',  sortable: true },
        { key: 'Tarifa',    label: 'Tarifa ', sortable: true },
        { key: 'Estado',    label: 'Estado', sortable: true},
        { key: 'actions',   label: '  ', 'class' : 'text-center' }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      sortBy: null,
      sortDesc: false,
      filter: null,
      modalInfo: { title: '', content: '' },
      //Agregar Formulario
      addInfo:{},
    }
  },
  created: function(){
    this.Cargadatos(this)
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
      this.modalInfo.title = `Row index: ${index}`
      this.modalInfo.content = JSON.stringify(item, null, 2)
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
      for(var i = 0; i < this.data.length; i++){
    
        this.items.push({
          Origen:{
			      id:this.data[i].ruta.origen.id,
			      nombre:this.data[i].ruta.origen.nombre
          },
		      Destino:{
            id:this.data[i].ruta.destino.id,
			      nombre:this.data[i].ruta.destino.nombre
          },
          Distancia:this.data[i].ruta.distancia,
			  	Duracion:this.data[i].ruta.duracion,
          Tarifa:this.data[i].ruta.tarifa_vuelo,
          Estado:'activo'		    
        });
      }
    }
  },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


<!-- table-complete-1.vue -->