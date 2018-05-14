<template>
    <div>
  <div class="row">
  
     <table class="table table-hover table-striped"> 
       <thead>
         <th> # </th>
         <th> Nombre </th>
         <th> Experiencia  </th>
         <th> Licencia </th>
       </thead>
       <tbody>
         <tr v-for="tripulante in this.pilotos"> 
           <td> {{tripulante.rango}} </td>
           <td> {{tripulante.empleado.nombre + " " + tripulante.empleado.apellido}} </td>
           <td> {{sumar(tripulante.empleado.experiencia)}} </td>
           <td> {{tripulante.licencia}} </td>
         </tr>
         <br />

       </tbody>
     </table>
  
  </div>
    </div>
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
        pilotos: [],
               
          
    }
  },
  computed: {
    
  },
  methods: { 
   
    Cargadatos(ctx){
      axios.get("/vuelos/pilotos").then(function(response){
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
        if(this.data.rango == "piloto")
         this.tripulantes.piloto.push({
             pilotos: this.data
         });
           
           
          
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