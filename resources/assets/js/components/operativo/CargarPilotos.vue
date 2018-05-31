<template>
    <div>
      <div class="row">
        <table class="table table-hover table-striped"> 
          <thead>
            <th> # </th>
            <th> Nombre </th>
            <th> Horas de Experiencia</th>
            <th> Vuelos de Quicena </th>
            <th> Asignar </th>
          </thead>
          <tbody>
            <tr v-for="tripulante in this.items"> 
              <td> {{tripulante.licencia}} </td>
              <td> {{tripulante.empleado.nombre}} </td>
              <td> {{sumar(tripulante.empleado.experiencia)}} </td>
            <!--   <td> {{tripulante.empleado.nombre}} </td> -->
         
            </tr>
            <br/>
          </tbody>
        </table>
      </div>
    </div>
</template>
<script>

import axios  from 'axios';




export default {
 
  props:[
    'fecha',
    'hora',
    'minuto',
    'segundo'
  ],
   created: function(){
  
    this.Cargadatos(this)

  },
 
  

  watch:{
      'fecha': function () {
       this.validar();
      }
    },

  data () {
    return {
        items: null,
        data: null,         
    }
  },
  computed: {
    
  },
  methods: { 
    validar(){
     if(this.isValidDate(this.fecha)){
       console.log("La fecha es correcta: " + this.fecha);
     }
    },
    isValidDate(dateString) {
      var regEx = /^\d{4}-\d{2}-\d{2}$/;
      if(!dateString.match(regEx)) return false;  // Invalid format
        var d = new Date(dateString);
        if(!d.getTime() && d.getTime() !== 0) return false; // Invalid date
        return d.toISOString().slice(0,10) === dateString;
    },
       
    Cargadatos(ctx){
      axios.get("/vuelos/pilotos").then(function(response){
      
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
        //console.log(this.data[i].tripulante   );
        if(this.data[i].tripulante.rango === 'piloto')
        this.items.push(
          this.data[i].tripulante
        
          
        );
      }
        
         
         
      
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