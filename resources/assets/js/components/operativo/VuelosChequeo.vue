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
       
        <b-button size="sm" @click.stop="ejecutar(row.item, row.index, $event.target)" class="mr-1" variant="primary">
          Ejecutar
        </b-button>
         <b-button size="sm" @click.stop="info(row.item, row.index, $event.target)" class="mr-1" variant="secundary">
          Ver
        </b-button>
        <b-button size="sm" @click.stop="cancelar(row.item, row.index, $event.target)" class="mr-1" variant="secundary">
          Cancelar
        </b-button>
        <div v-if="row.item.Estado == 'abierto'">
         <!--  <b-button size="sm" @click.stop="Deshabilitar(row)">
            Cancelar
          </b-button> -->
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
    <b-modal  ref="myModalRef" size="lg" id="VuelosChequeados" @hide="resetModal" :title="modalInfo.title"  hide-footer>
    <div id="imprimir" v-if="modalInfo.content != ''">
    <b-form @submit.prevent="imprimir()">
      
      <!--  <pre> {{modalInfo.content}} </pre>   -->
     <div class="card-header">
      
         <h5 align="center">
         <label class="infoTitulo" for="inputPuesto">Fecha: {{modalInfo.content.Fecha}}</label>
         <label class="infoTitulo" for="inputPuesto">Hora: {{modalInfo.content.Hora}}</label>
        </h5>
       
     </div>
     
      
      <h3> Tripulacion a Bordo </h3>
     <table class="table  table-striped"> <!--  -->
       <thead>
         <th> # </th>
         <th> Nombre </th>
         <th> Experiencia  </th>
         <th> Licencia </th>
       </thead>
       <tbody>
         <tr v-for="tripulante in modalInfo.content.tripulantes"> 
           <td v-if="tripulante.empleado.cargo_id=='8'"> Piloto </td>
           <td v-if="tripulante.empleado.cargo_id=='9'"> Copiloto </td>
           <td v-if="tripulante.empleado.cargo_id=='10'"> Sobrecargo </td>
           <td v-if="tripulante.empleado.cargo_id=='14'"> Jefe de Cabina </td>
           <td> {{tripulante.empleado.nombre + " " + tripulante.empleado.apellido}} </td>
           <td> {{sumar(tripulante.empleado.experiencia)}} </td>
           <td> {{tripulante.licencia}} </td>
         </tr>
         <br />

       </tbody>
     </table>
     <h3> Pasajeros a Bordo </h3>
     <table class="table  table-striped" ><!--  -->
       <thead>
         <th> Nombre </th>
         <th> Cedula  </th>
         <th> Boleto </th>
         <th> Asiento </th>
       </thead>
       <tbody>
         <tr v-for="boleto in modalInfo.content.boletos"> 
          
           <td v-show="boleto.boleto_estado=='Chequeado'"> {{boleto.primerNombre}} {{boleto.apellido}} </td>
           <td v-show="boleto.boleto_estado=='Chequeado'" > {{boleto.documento}} </td>
           <td v-show="boleto.boleto_estado=='Chequeado'"> {{boleto.boleto_estado}} </td>
           <td v-show="boleto.boleto_estado=='Chequeado'"> {{boleto.asiento}} </td>
         </tr>
         <br />
       </tbody>
     </table>
      <div id="datos_ruta" slot="modal-footer" class="w-100">
            <div v-for="segmento in modalInfo.content.segmentos">
              <div class="row">
              <div class="form-gruop">&nbsp;&nbsp;<strong>Ruta:</strong> {{segmento.ruta.sigla}} <strong>||</strong> Modelo de Aeronave: {{segmento.aeronave.modelo}} <strong>||</strong> Matricula: {{segmento.aeronave.matricula}} <strong>||</strong> Ultimo Mantenimiento: {{segmento.aeronave.ultimo_mantenimiento}} <hr size="5" style="color: #0056b2;" />
              </div>

          </div>                      
         </div>
      </div>
    <div class="text-center">
        <b-button type="submit" variant="primary" >Generar Manifiesto de Vuelo</b-button>
      </div>
    </b-form>
    </div>
     
    </b-modal>

    
    
  </b-container>
</template>

<script>

import axios  from 'axios';
//import jsPDF from 'jsPDF';

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
        { key: 'N_Vuelo',    label: 'Numero de Vuelo',  sortable: true },
        { key: 'Ruta',   label: 'Segmentos', sortable: true },
        { key: 'Fecha', label: 'Fecha ', sortable: true },
        { key: 'Hora',  label: 'Hora ',  sortable: true },
        { key: 'Estado',    label: 'Status ', sortable: true },
        { key: 'actions',   label: ' '}
      ],      
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      sortBy: null,
      sortDesc: false,
      filter: null,
      modalInfo: { title: '', content: '' },
      tripulantes: [
        {
          piloto: [],
          copiloto: [],
          jefe_cabina: [],
          sobrecargo1: [], 
          sobrecargo2: [], 
          sobrecargo3: [], 
        }
      ]

      
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
    imprimir(){
        var jsPDF = require('jspdf');
        require('jspdf-autotable');
        let pdfName = 'Manifiesto'+this.modalInfo.content.N_Vuelo; 
        var doc = new jsPDF();
         var columns_tripulantes = ["#", "Nombre", "Experiencia", "Licencia"];
          var data_tripulantess = [];     
        doc.setFontSize ( 20 );
        doc.text(this.modalInfo.title,25,20);
        doc.setFontSize(14);
        doc.text("Lista de Tripulantes:",15,30);
        doc.setFontSize ( 8 );
        doc.setFontSize(5);
        for(var i=0;i<this.modalInfo.content.tripulantes.length;i++){
       var sumarexperiencia = this.sumar(this.modalInfo.content.tripulantes[i].empleado.experiencia); 
       var cargo='';
       if(this.modalInfo.content.tripulantes[i].empleado.cargo_id=='8'){cargo='Piloto'}
       if(this.modalInfo.content.tripulantes[i].empleado.cargo_id=='9'){cargo='Copiloto'}
       if(this.modalInfo.content.tripulantes[i].empleado.cargo_id=='10'){cargo='Sobrecargo'}
       if(this.modalInfo.content.tripulantes[i].empleado.cargo_id=='14'){cargo='Jefe de Cabina'}
      data_tripulantess.push([cargo,this.modalInfo.content.tripulantes[i].empleado.nombre+" "+this.modalInfo.content.tripulantes[i].empleado.apellido,sumarexperiencia,this.modalInfo.content.tripulantes[i].licencia]);
    }
    doc.autoTable(columns_tripulantes, data_tripulantess, {startY: 35});
    var first = doc.autoTable.previous;
    var columns = ["Cedula", "Nombre", "Boleto", "Asiento"];
    var data2= [];   
        for(var i=0;i<this.modalInfo.content.boletos.length;i++){
         if(this.modalInfo.content.boletos[i].boleto_estado=='Chequeado'){ 
        data2.push([this.modalInfo.content.boletos[i].documento,this.modalInfo.content.boletos[i].primerNombre+" "+this.modalInfo.content.boletos[i].apellido,this.modalInfo.content.boletos[i].boleto_estado,this.modalInfo.content.boletos[i].asiento]);
        }
      }  
    doc.setFontSize(14);
    doc.text("Lista de Pasajeros A bordo:",15,first.finalY+15);
    doc.autoTable(columns, data2, {
        startY: first.finalY + 20,
        showHeader: 'firstPage',
       
    });
    var first2 = doc.autoTable.previous;

    doc.fromHTML($('#datos_ruta').html(),5,first2.finalY+15);
    doc.save(pdfName + '.pdf'); 
    },
    cancelar(item, index, button){
       this.$dialog.confirm('Esta opcion no puede ser revertida')
       .then(function(){
          axios({
                method: 'post',
                url: '/vuelos/cancelar',
                data: item
                
               }).then((response)=>{
             
                Vue.toasted.show(response.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                });
                EventBus.$emit('actualizartabla',true);
                  this.$root.$emit('bv::hide::modal', 'agregar', '#app');
               }).catch((err) =>{

               });
       })
       .catch(function(){
          console.log('Cancelar esta Operacion')
       })
    },
    ejecutar (item, index, button){
      this.$dialog.confirm('Esta opcion no puede ser revertida')
	    .then(function () {
		    axios({
                method: 'post',
                url: '/vuelos/ejecutar',
                data: item
                
               }).then((response)=>{
             
                Vue.toasted.show(response.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                });
                EventBus.$emit('actualizartabla',true);
                  this.$root.$emit('bv::hide::modal', 'agregar', '#app');
               }).catch((err) =>{

               });
	    })
	      .catch(function () {
		    console.log('Cancelar esta Operacion')
	    });
    },
    info (item, index, button) {
      this.modalInfo.content = item;
      this.modalInfo.title = "Datos del Vuelo: " + item.N_Vuelo;
  
           
       
             this.$root.$emit('bv::show::modal', 'VuelosChequeados', button)
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
      axios.get("/vuelos/vuelos/manifiesto").then(function(response){
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
          if( this.data[i].vuelo.estado == "chequeando"){    
            var rutas = "";
            for(var j = 0; j < this.data[i].vuelo.segmentos.length; j++){
              rutas += "[" + this.data[i].vuelo.segmentos[j].ruta.sigla + "] ";
            }
            var fecha = this.data[i].vuelo.fecha_salida.split(" ")[0];
            var hora = this.data[i].vuelo.fecha_salida.split(" ")[1];
            this.items.push({
              id: this.data[i].vuelo.id,
              N_Vuelo: this.data[i].vuelo.n_vuelo,
              Ruta: rutas,
              Fecha: fecha,
              Hora: hora,
              Estado: this.data[i].vuelo.estado,
              tripulantes: this.data[i].vuelo.tripulantes,
              segmentos: this.data[i].vuelo.segmentos,
              boletos: this.data[i].vuelo.boletos   
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
      return horas + ":" + minutos + ":" + segundos;
    }
  }
}
</script>

<!-- table-complete-1.vue -->



<style>
.dg-content {
    text-align: center;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size:20px;
 }
.dg-btn--ok {
  color: white;
  border-color: red;
  background-color: red
}
</style>
