<template>
    <div>
        <!-- Agregar -->
        <b-form @submit.prevent="enviarFechas()">
           <multiselect v-model="ruta" 
                        :options="rutas" 
                        selectLabel="Seleccionar" 
                        deselectLabel="Eliminar" 
                        selectedLabel="Seleccionado" 
                        placeholder="Seleccione el Origen" 
                        label="nombre" 
                        track-by="nombre"
                        ></multiselect>
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
                            <b-form-input type="number" min="0" max="24" required class="form-control" id="ccyear" placeholder="hora" v-model="hora"></b-form-input> 
                        </div>
                        <div class="form-group col-sm-4 ">                          
                            <b-form-input type="number" min="0" max="60" required class="form-control" id="ccyear" placeholder="minutos" v-model="minutos"></b-form-input>
                        </div>
                        <div class="form-group col-sm-4 ">                         
                            <b-form-input type="number" min="0" max="60" required class="form-control" id="ccyear" placeholder="segundos" v-model="segundos"></b-form-input>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-md-3 text-center">
                <div class="">
                    <label for="duracion" class="text-center"> <b style="color:white"> - </b> </label> 
                    <div class=" col-sm-12 " >
                        <b-button size="sm"  type="submit" variant="primary">                             
                            <i class="fa fa-search">Buscar Tripulantes</i>
                        </b-button>
                    </div>
                </div>
            </div>
        </div>
        </b-form>
           
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
                                <td> {{tripulante.nombre + " " + tripulante.apellido}} </td>
                                <td> {{sumar(tripulante.pihe)}} </td>
                                <td> {{tripulante.pihp.cantidad}} </td>
                                <td> <label><input type="radio" name="piloto">Seleccionar</label> </td>
                            </tr>
                            <br/>
                        </tbody>
                    </table>
                </b-tab>
                <b-tab title="Copiloto">
                    <table class="table table-hover table-striped"> 
                        <thead>
                            <th> # </th>
                            <th> Nombre </th>
                            <th> Horas de Experiencia</th>
                            <th> Vuelos de Quicena </th>
                            <th> Asignar </th>
                        </thead>
                        <tbody>
                            <tr v-for="tripulante in this.items2"> 
                                <td> {{tripulante.licencia}} </td>
                                <td> {{tripulante.nombre + " " + tripulante.apellido}} </td>
                                <td> {{sumar(tripulante.copihe)}} </td>
                                <td> {{tripulante.copihp.cantidad}} </td>
                                <td> <label><input type="radio" name="copiloto">Seleccionar</label> </td>
                            </tr>
                            <br/>
                        </tbody>
                    </table>           
                </b-tab>
                <b-tab title="Jefe de Cabina">
                   <table class="table table-hover table-striped"> 
                        <thead>
                            <th> # </th>
                            <th> Nombre </th>
                            <th> Horas de Experiencia</th>
                            <th> Vuelos de Quicena </th>
                            <th> Asignar </th>
                        </thead>
                        <tbody>
                            <tr v-for="tripulante in this.items3"> 
                                <td> {{tripulante.licencia}} </td>
                                <td> {{tripulante.nombre + " " + tripulante.apellido}} </td>
                                <td> {{tripulante.jche}} </td>
                                <td> {{tripulante.jchp.cantidad}} </td>
                                <td> <label><input type="radio" name="jefecabina">Seleccionar</label> </td>
                            </tr>
                            <br/>
                        </tbody>
                    </table>
                
                </b-tab>
                <b-tab title="Sobrecargo">
                    <table class="table table-hover table-striped"> 
                        <thead>
                            <th> # </th>
                            <th> Nombre </th>
                            <th> Horas de Experiencia</th>
                            <th> Vuelos de Quicena </th>
                            <th> Asignar </th>
                        </thead>
                        <tbody>
                            <tr v-for="tripulante in this.items4"> 
                                <td> {{tripulante.licencia}} </td>
                                <td> {{tripulante.nombre + " " + tripulante.apellido}} </td>
                                <td> {{sumar(tripulante.sohe)}} </td>
                                <td> {{tripulante.sohp.cantidad}} </td>
                                <td> <label><input type="radio" name="sobrecargo">Seleccionar</label> </td>
                            </tr>
                            <br/>
                        </tbody>
                    </table>
                  
                
                </b-tab>   
                <b-tab title="Aeronave">
                  
                   
              </b-tab>
            </b-tabs>
             <div class=" col-sm-12 " >
                        <b-button size="sm"  variant="primary">                             
                            <i>Guardar Vuelo</i>
                        </b-button>
                    </div>
        </div> <!-- cierre del v-if -->

       
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
            items2: null,   
            items3: null,
            items4: null,
            data: null,   
        }              
    },   
    created: function(){
       this.cargarRutas()
    },
    methods: {
        Buscar(){
            this.enviarFechas();
           
            
        },
        enviarFechas(){
            this.oculto = true;
            axios({
                method: 'post',
                url: '/vuelos/disponibilidad',
                data: {
                   fecha: this.fecha + " " + this.hora +":" + this.minutos +":" + this.segundos
                   
                }
                }).then((response) =>{
                    this.data = response.data;
                    this.formatodatos();
                    
                    
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
            this.items2 = [];
            this.items3 = [];
            this.items4 = [];
          
            for (var i= 0; i < this.data.piloto.length; i++){
                this.items.push(
                    this.data.piloto[i],                     
                );       
            }
            for (var i= 0; i < this.data.copiloto.length; i++){
                this.items2.push(
                    this.data.copiloto[i], 
                );
            }
            for (var i= 0; i < this.data.jefac.length; i++){
                this.items3.push(
                    this.data.jefac[i], 
                );
            }
            for (var i= 0; i < this.data.sobrecargo.length; i++){
                this.items4.push(
                    this.data.sobrecargo[i], 
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
                console.log(err);
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
                    nombre: data.data[i].ruta.origen.ciudad + " (" + data.data[i].ruta.origen.nombre 
                            + ")-"+data.data[i].ruta.origen.sigla + " <-----> " + data.data[i].ruta.destino.ciudad + " (" + data.data[i].ruta.destino.nombre +")-"+data.data[i].ruta.destino.sigla
                });
            }


        },
        
        sumar(experiencias){
            console.log(experiencias);
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
            
            if(segundos < 10)
                return horas + ":" + minutos + ":" + segundos+"0";
            else
               return horas + ":" + minutos + ":" + segundos;
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"> </style>

