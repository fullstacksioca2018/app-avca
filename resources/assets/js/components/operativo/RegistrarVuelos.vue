<template>
    <div>
        <!-- Agregar -->
        
           <multiselect v-model="ruta" 
                        :options="rutas" 
                        selectLabel="Seleccionar" 
                        deselectLabel="Eliminar" 
                        selectedLabel="Seleccionado" 
                        placeholder="Seleccione el Origen" 
                        label="nombre" 
                        track-by="nombre"></multiselect>
        <br/>
        <div class="row">
            <div class="col-md-5 text-center">
                <div class="">
                    <div class="col-md-3"></div>
                    <b-form-group align="center" id="fecha_salida"
                      label="Fecha Salida"
                      label-for="fecha_salida">
                        <b-form-input id="fecha_salida"
                            type="date"
                            class="col-md-6"
                            v-model="fecha"
                           

                            required>
                        </b-form-input>
                    </b-form-group>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="">
                    <label for="duracion" class="text-center"> <b> Hora del Vuelo: </b> </label> 
                    <div class="row" id="duracion">
                        <div class="col-sm-4 ">
                            
                            <b-form-input type="number" min="0" max="24" class="form-control" id="ccyear" placeholder="hora" v-model="hora"></b-form-input> 
                         </div>
                        <div class="form-group col-sm-4 ">
                          
                            <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" placeholder="minutos" v-model="minutos"></b-form-input>
                        </div>
                        <div class="form-group col-sm-4 ">
                         
                            <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" placeholder="segundos" v-model="segundos"></b-form-input>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-3 text-center">
                <div class="">
                    <label for="duracion" class="text-center"> <b style="color:white"> - </b> </label> 
                    <div class=" col-sm-12 " >
                         <b-button size="sm" variant="primary" @click.prevent="Buscar()">
                    <i class="fa fa-search">Buscar</i>
                </b-button>
                    </div>
                </div>
                
            </div>
           
            <div class="col-md-12">
                <!-- AQUI VA LA CARGA DE TRIPULANTES Y LA AERONAVE -->
       
        <div class="form-group text-center" v-if="oculto"> <!-- AQUI VA EL V-IF DE VERIFICACION -->
             <!-- AQUI VAN LAS PESTANAS PARA CARGAR LA TRIPULACION -->
                <b-tabs pills card >
                <b-tab title=" Piloto" active>
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
                 
               </b-tab>
                <b-tab title="Copiloto">
                   
                
                </b-tab>
                <b-tab title="Jefe de Cabina">
                   
                
                </b-tab>
                <b-tab title="Sobrecargo">
                  
                
                </b-tab>   
                <b-tab title="Aeronave">
                  
                   
              </b-tab>
            </b-tabs>
            
        </div> <!-- cierre del v-if -->

       
            </div>

        
        </div>
       
    </div>
</template>
<script>
import multiselect from 'vue-multiselect'
export default {
    
    components: {
        multiselect
    },
    data(){
        return{
            ruta: null,
            fecha: null,
            hora: null,
            minutos: null,
            segundos: null,        
            horavuelo : null,
            itemspilotos: null,            
            rutas: [],
            oculto: false,   
            items: null,    
            data: null,   
        }              
    },   
    created: function(){
       this.cargarRutas()
    },
    methods: {
        Buscar(){
            this.enviarFechas();
            this.Cargadatos(this);
            this.oculto = true;
        },
        enviarFechas(){
            axios({
                method: 'post',
                url: '/vuelos/tripulantes',
                data: {
                   fecha: this.fecha + " " + this.hora +":" + this.minutos +":" + this.segundos
                }
                }).then((response) =>{
                    Vue.toasted.show(response.data, {
                        theme: "primary", 
	                    position: "bottom-right",
	                    duration : 2000
                    });
                    //this.$refs.myModalRef.hide();
                }).catch((err)=>{
                    Vue.toasted.show('Ha ocurrido un error', {
                        theme: "primary", 
	                    position: "bottom-right",  
	                    duration : 2000
                    });
                    console.log(err);
                });
            },
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
                //console.log(this.data[i].tripulante   );
                if(this.data[i].tripulante.rango === 'piloto')
                this.items.push(
                this.data[i].tripulante
                
                
                );
            }
        },
        cargarRutas(){
            axios({
                method: 'get',
                url: '/vuelos/rutas'       
            }).then((response) =>{
                this.formatorutas(response);
            }).catch((err)=>{
                Vue.toasted.show('Ha ocurrido un error', {
                    theme: "primary", 
                    position: "bottomright",  
                    duration : 2000
                });
                console.log(err);
            });
        },
        formatorutas(data){
            console.log(data);
            for(var i=0; i < data.data.length; i++){
                this.rutas.push({
                    id: data.data[i].ruta.id,
                    nombre: data.data[i].ruta.origen.nombre + " (" + data.data[i].ruta.origen.aeropuerto + ") -->" + data.data[i].ruta.destino.nombre + " (" + data.data[i].ruta.destino.aeropuerto
                });
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

<style src="vue-multiselect/dist/vue-multiselect.min.css"> </style>

