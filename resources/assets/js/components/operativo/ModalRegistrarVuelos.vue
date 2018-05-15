<template>
    <div>
        <!-- Agregar -->
        <b-modal id="agregar" size="lg" ref="modal" title="Registrar Vuelo">
           <multiselect v-model="form.ruta" 
                        :options="rutas" 
                        selectLabel="Seleccionar" 
                        deselectLabel="Eliminar" 
                        selectedLabel="Seleccionado" 
                        placeholder="Seleccione el Origen" 
                        label="nombre" 
                        track-by="nombre"></multiselect>
        <br/>
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="">
                    <div class="col-md-3"></div>
                    <b-form-group id="fecha_salida"
                      label="<b>Fecha Salida</b>"
                      label-for="fecha_salida">
                        <b-form-input id="fecha_salida"
                            type="date"
                            class="col-md-6"
                            required>
                        </b-form-input>
                    </b-form-group>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="">
                    <label for="duracion" class="text-center"> <b> Tiempo de Vuelo: </b> </label> 
                    <div class="row" id="duracion">
                        <div class="col-sm-4 ">
                            <span class="help-block"> Horas </span>
                            <b-form-input type="number" min="0" max="24" class="form-control" id="ccyear" placeholder="00" ></b-form-input> 
                         </div>
                        <div class="form-group col-sm-4 ">
                            <span class="help-block"> Minutos </span>
                            <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" placeholder="00" ></b-form-input>
                        </div>
                        <div class="form-group col-sm-4 ">
                            <span class="help-block"> Segundos </span>
                            <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" placeholder="00" ></b-form-input>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12">
                <!-- AQUI VA LA CARGA DE TRIPULANTES Y LA AERONAVE -->
       
        <div class="form-group text-center"> <!-- AQUI VA EL V-IF DE VERIFICACION -->
             <!-- AQUI VAN LAS PESTANAS PARA CARGAR LA TRIPULACION -->
                <b-tabs pills card >
                <b-tab title=" Piloto" active>
                    <CargarPilotos> </CargarPilotos>
                
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
        </b-modal>
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
            form:{
                ruta: null,
                fechavuelo : null,
                horavuelo : null,
                tripulante: {
                    piloto: null,
                    copiloto: null,
                    jefecabina: null,
                    sobrecargos:[{

                    }],
                    aeronave: null,
                }
            },
            rutas: []
        }       
       
    },   
    created: function(){
        this.cargarRutas();
    },
    methods: {
        cargarRutas: function(){
            axios({
                method: 'get',
                url: '/vuelos/rutas'       
            }).then((response) =>{
                this.formatorutas(response);
            }).catch((err)=>{
                Vue.toasted.show('Ha ocurrido un error', {
                    theme: "primary", 
                    position: "bottom-right",  
                    duration : 2000
                });
                console.log(err);
            });
        },
        formatorutas: function(data){
            console.log(data);
            for(var i=0; i < data.data.length; i++){
                this.rutas.push({
                    id: data.data[i].ruta.id,
                    nombre: data.data[i].ruta.origen.nombre + " (" + data.data[i].ruta.origen.aeropuerto + ") -->" + data.data[i].ruta.destino.nombre + " (" + data.data[i].ruta.destino.aeropuerto
                });
            }


        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"> </style>

