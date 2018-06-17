 <template> 
    <div>
        <div class="col-md-12 order-md-12 mb-12 box wow bounceInUp" >
            <!-- <h3 class="mb-7 ml-7">Datos de Vuelos</h3> -->
              <div class="container pasajero box wow fadeInLeft">
               
                <div class="card" v-if="Lunes.length>0">
                 <div>
                     <b-btn v-b-toggle.collapse1 variant="primary">Lunes</b-btn>
                     <b-collapse id="collapse1" class="mt-2">
                     <b-card>
                       <div v-for="item in Lunes"> 
                    
                            <div > {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                            <div > {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                            <div > Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                            <hr>
                        </div>
                     </b-card>
                     </b-collapse>
                 </div>
                </div>
                
                <div class="card" v-if="Martes.length>0">
                      <div>
                     <b-btn v-b-toggle.collapse2 variant="primary">Martes</b-btn>
                     <b-collapse id="collapse2" class="mt-2">
                     <b-card>
                       <div v-for="item in Martes"> 
                    
                            <div > {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                            <div > {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                            <div > Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                 <hr>
                        </div>
                     </b-card>
                     </b-collapse>
                 </div>
                </div>
                
                <div class="card" v-if="Miercoles.length>0">
                      <div>
                     <b-btn v-b-toggle.collapse3 variant="primary">Miercoles</b-btn>
                     <b-collapse id="collapse3" class="mt-2">
                     <b-card>
                       <div v-for="item in Miercoles"> 
                    
                            <div > {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                            <div > {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                            <div > Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                                             <hr>
                        </div>
                     </b-card>
                     </b-collapse>
                 </div>
                </div>

                <div class="card" v-if="Jueves.length>0" >
                    <div>
                     <b-btn v-b-toggle.collapse4 variant="primary">Jueves</b-btn>
                     <b-collapse id="collapse4" class="mt-2">
                     <b-card>
                       <div v-for="item in Jueves"> 
                    
                            <div > {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                            <div > {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                            <div > Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                                             <hr>
                        </div>
                     </b-card>
                     </b-collapse>
                 </div>
                </div>

                <div class="card" v-if="Viernes.length>0">
                    <div>
                     <b-btn v-b-toggle.collapse5 variant="primary">Viernes</b-btn>
                     <b-collapse id="collapse5" class="mt-2">
                     <b-card>
                       <div v-for="item in Viernes"> 
                    
                            <div > {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                            <div > {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                            <div > Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                                             <hr>
                        </div>
                     </b-card>
                     </b-collapse>
                 </div>
                </div>

                <div class="card" v-if="Sabado.length>0">
                     <div>
                     <b-btn v-b-toggle.collapse6 variant="primary">Sabado</b-btn>
                     <b-collapse id="collapse6" class="mt-2">
                     <b-card>
                       <div v-for="item in Sabado"> 
                    
                            <div > {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                            <div > {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                            <div > Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                             <hr>                
                        </div>
                     </b-card>
                     </b-collapse>
                 </div>
                </div>

                <div class="card" v-if="Domingo.length>0">
                     <div>
                     <b-btn v-b-toggle.collapse7 variant="primary">Domingo</b-btn>
                     <b-collapse id="collapse7" class="mt-2">
                     <b-card>
                       <div v-for="item in Domingo"> 
                    
                            <div > {{item.n_vuelo}} | {{item.Fecha}} - {{item.Hora}}</div>
                            <div > {{item.Ruta.Origen.sigla}} - {{item.Ruta.Destino.sigla}}</div>
                            <div > Disponibilidad {{item.boletos - (item.vendidos + item.reservados)}}</div>
                            <hr>                 
                        </div>
                     </b-card>
                     </b-collapse>
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
     items:'',
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
        console.log("err al cargador datos");
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



