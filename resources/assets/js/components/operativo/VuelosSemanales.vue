<template> 
    <div>
        <div class="col-md-12 order-md-12 mb-12 box wow bounceInUp" >
            <!-- <h3 class="mb-7 ml-7">Datos de Vuelos</h3> -->
              <div class="container pasajero box wow fadeInLeft">
               
                <div class="card" v-if="Lunes.length>0">
                     <strong>Lunes</strong>
                <div v-for="item in Lunes"> 
                    
                    <div class="card-header"> {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                    <div class="card-body"> {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                    <div class="card-footer"> Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                 
                </div>
                </div>
                
                <div class="card" v-if="Martes.length>0">
                     <strong>Martes</strong>
                <div v-for="item in Martes"> 
                
                    <div class="card-header"> {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                    <div class="card-body"> {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                    <div class="card-footer"> Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                
                </div>
                </div>
                
                <div class="card" v-if="Miercoles.length>0">
                     <strong>Miercoles</strong>
                <div v-for="item in Miercoles"> 
            
                    <div class="card-header"> {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                    <div class="card-body"> {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                    <div class="card-footer"> Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                 
                </div>
                </div>

                <div class="card" v-if="Jueves.length>0" >
                     <strong>Jueves</strong>
                <div  v-for="item in Jueves"> 
             
                    <div class="card-header"> {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                    <div class="card-body"> {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                    <div class="card-footer"> Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                
                </div>
                </div>

                <div class="card" v-if="Viernes.length>0">
                     <strong>Viernes</strong>
                <div v-for="item in Viernes"> 
                    <div class="card-header"> {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                    <div class="card-body"> {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                    <div class="card-footer"> Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                </div>
                </div>

                <div class="card" v-if="Sabado.length>0">
                     <strong>Sabado</strong>
                <div v-for="item in Sabado"> 
                    <div class="card-header"> {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                    <div class="card-body"> {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                 </div>
                </div>
                </div>

                <div class="card" v-if="Domingo.length>0">
                     <strong>Domingo</strong>
                <div v-for="item in Domingo"> 
                    <div class="card-header"> {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                    <div class="card-body"> {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                    <div class="card-footer"> Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                </div>
                </div>

              </div>         
          </div>
    </div> 
</template>

<script> 
import axios  from 'axios';
import moment from 'moment';
moment.locale('es');
export default {

  created: function(){
    this.Cargadatos(this);
  },
  data () {
    return {
     Lunes:'',
     Martes:'',
     Miercoles:'',
     Jueves:'',
     Viernes:'',
     Sabado:'',
     Domingo:''

    }
  },
  methods: {
    Cargadatos(ctx){
      axios.get("/taquilla/vuelos").then(function(response){
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
     this.Lunes = [];
     this.Martes = [];
     this.Miercoles = [];
     this.Jueves = [];
     this.Viernes = [];
     this.Sabado = [];
     this.Domingo = [];    
       for (var i= 0; i < this.data.length; i++){
        var elementos=this.data[i].fecha_salida.split(' ');
       if(moment(elementos[0]).format('dddd')=='lunes'){
       this.Lunes.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
       }//fin lunes
       if(moment(elementos[0]).format('dddd')=='martes'){
       this.Martes.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
       }//fin Martes
       if(moment(elementos[0]).format('dddd')=='miercoles'){
       this.Miercoles.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
       }//fin miercoles
       if(moment(elementos[0]).format('dddd')=='jueves'){
       this.Jueves.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
       }//fin jueves
       if(moment(elementos[0]).format('dddd')=='viernes'){
       this.Viernes.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
       }//fin viernes
       if(moment(elementos[0]).format('dddd')=='sabado'){
       this.Sabado.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
       }//fin sabado
       if(moment(elementos[0]).format('dddd')=='domingo'){
       this.Domingo.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].n_vuelo,
          estado: this.data[i].estado,
          Fecha: moment(elementos[0]).format('DD-MM-YYYY'),
          Hora: elementos[1],
          Estado: this.data[i].estado,
          Duracion: this.data[i].segmentos[0].ruta.duracion,
          boletos: this.data[i].n_boletos,
          vendidos: this.data[i].boletos_vendidos,
          reservados: this.data[i].boletos_reservados,
          Ruta:{
                 Origen: {
                      id: this.data[i].segmentos[0].ruta.origen.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.origen.nombre,
                      sigla: this.data[i].segmentos[0].ruta.origen.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.origen.ciudad
                  }, 
                  Destino: {
                      id: this.data[i].segmentos[0].ruta.destino.sucursal_id,
                      nombre: this.data[i].segmentos[0].ruta.destino.nombre,
                      sigla: this.data[i].segmentos[0].ruta.destino.sigla,
                      ciudad: this.data[i].segmentos[0].ruta.destino.ciudad
                  }
          }
        });
       }//fin
      }
      
    } 
  }
} 
</script>



