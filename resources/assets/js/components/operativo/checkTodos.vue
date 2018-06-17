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
     <template slot="boletos" slot-scope="row">{{ row.value.length }}</template>
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
          
          <b-button size="sm" class="btn btn-warning btn-sm" @click.stop="info(row.item,row.item, row.index, $event.target)" variant="success">
            Visualizar
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
     <b-form @submit.prevent="imprimir(modalInfo)"> 
            <!--  <pre>{{modalInfo.content}}</pre>    -->
       <div id="boletos" class="row">
         <div class="col-sm-12">
          <!--  <h4> -- Chequeados --</h4> -->
       <table class="table table-hover table-striped" > <!--  -->
       <thead>
         <th> Nombre </th>
         <th> Cedula  </th>
         <th> Boleto </th>
         <th> Asiento </th>
       </thead>
       <tbody>
         <tr v-for="boleto in modalInfo.content.boletos"> 
          
           <td v-show="boleto.boleto_estado=='Chequeado'"> {{boleto.primerNombre}} {{boleto.apellido}} </td>
           <td v-show="boleto.boleto_estado=='Chequeado'" > {{boleto.tipo_documento}}-{{boleto.documento}} </td>
           <td v-show="boleto.boleto_estado=='Chequeado'"> {{boleto.boleto_estado}} </td>
           <td v-show="boleto.boleto_estado=='Chequeado'"> {{boleto.asiento}} </td>
         </tr>
         <br />
       </tbody>
     </table>
      
         </div>
       </div>
          
         

         <div class="row"><p></p></div>  
      <div class="text-center">
        <b-button type="submit" variant="primary" >Generar Lista de Chequeo</b-button>
      </div>
     </b-form>
     </div>
   <!--  </div> -->
     
    </b-modal> 
  
  </b-container>
</template>

<script>

import axios  from 'axios';
import moment from 'moment';
import {EventBus} from './event-bus.js';
//import jsPDF from 'jsPDF';
<<<<<<< HEAD
=======
//import autotable from 'jspdf-autotable';
>>>>>>> 7b3f0fbb3d2abf69c143fcbb5d5d3e4649f6eac4
moment.locale('es');

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
        { key: 'origen', label: 'Origen ', sortable: true},
        { key: 'destino', label: 'Destino ', sortable: true},
        { key: 'boletos',   label: 'Boletos Vendidos', sortable: true },
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
  methods: {
    
    imprimir(){
    var jsPDF = require('jspdf');
    require('jspdf-autotable');
    let pdfName = 'Manifiesto'+this.modalInfo.content.n_vuelo; 
    var doc = new jsPDF();
    //doc.text("Vuelo: ",20, 10);
     doc.setFontSize ( 20 );
    doc.text(this.modalInfo.title,25,20);
    doc.setFontSize(14);
    doc.text("Lista de Pasajeros:",15,30);
    doc.setFontSize ( 8 );
    doc.setFontSize(5);
   // doc.fromHTML($("#boletos").html(),15,36);
  
    var columns = ["Cedula", "Nombre", "Boleto", "Asiento"];
    var data = [];
    for(var i=0;i<this.modalInfo.content.boletos.length;i++){
      if(this.modalInfo.content.boletos[i].boleto_estado=='Chequeado'){
      data.push([this.modalInfo.content.boletos[i].documento,this.modalInfo.content.boletos[i].primerNombre+" "+this.modalInfo.content.boletos[i].apellido,this.modalInfo.content.boletos[i].boleto_estado,this.modalInfo.content.boletos[i].asiento]);
      }
    }
  
    doc.autoTable(columns,data,
        { margin:{ top: 35 }}
        );
    doc.save(pdfName + '.pdf'); 
    },
    
    info (item, index, button) {
      this.modalInfo.title = "Vuelo: "+item.n_vuelo+" || "+item.fecha+" || ["+item.origen+"-"+item.destino+"]";
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
      axios.get("/check/todos").then(function(response){
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
        var elementos=this.data[i].fecha_salida.split(' ');
        this.items.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          hora: elementos[1],
          origen:this.data[i].origen,
          destino:this.data[i].destino,
          boletos:this.data[i].boletos
        });
      }
     
    },
  }
} 
</script>