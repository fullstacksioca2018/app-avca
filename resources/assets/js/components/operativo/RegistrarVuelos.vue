<template>
    <div>
        <!-- Agregar -->
        <b-form @submit.prevent="enviarFechas" >
            <multiselect v-model="ruta" 
                        :options="rutas" 
                        selectLabel="Seleccionar" 
                        deselectLabel="Eliminar" 
                        selectedLabel="Seleccionado" 
                        placeholder="Seleccione el Origen" 
                        label="nombre" 
                        track-by="nombre"
                        required
            ></multiselect>
            <br/>
            <div class="row">
                <div class="col-md-5 text-center">
                    <div class="col-md-3"></div>
                        <b-form-group   align="center" id="fecha_salida"
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
                    <div class="col-md-4 text-center">
                        <div class="">
                            <label for="duracion" class="text-center"> <b> Hora del Vuelo: </b> </label> 
                            <div class="row" id="duracion">
                            <div class="col-sm-4 ">                            
                                <b-form-input type="number" min="0" max="23" required class="form-control" id="ccyear" placeholder="hora" v-model="hora"></b-form-input> 
                            </div>
                            <div class="form-group col-sm-4 ">                          
                                <b-form-input type="number" min="0" max="59" required class="form-control" id="ccyear" placeholder="minutos" v-model="minutos"></b-form-input>
                            </div>
                            <div class="form-group col-sm-4 ">                         
                                <b-form-input type="number" min="0" max="59" required class="form-control" id="ccyear" placeholder="segundos" v-model="segundos"></b-form-input>
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
        <b-form @submit.prevent="onSubmit"> 
        <!-- Parte II  -->
        <div class="col-md-12">
            <!-- AQUI VA LA CARGA DE TRIPULANTES Y LA AERONAVE -->
            <div class="form-group text-center" v-if="oculto"> <!-- AQUI VA EL V-IF DE VERIFICACION -->
                <!-- AQUI VAN LAS PESTANAS PARA CARGAR LA TRIPULACION -->
                    <b-tabs pills card >
                        <b-tab title="Aeronave" active>
                            <b-form-radio-group id="jefecabina" v-model="form.aeronave" name="aeronave" required>
                            <table class="table table-hover table-striped"> 
                                <thead>
                                    <th> Aeronave </th>
                                    <th> Modelo </th>
                                    <th> Horas de Vuelo</th>
                                    <th> Asignar </th>
                                </thead>
                                <tbody>
                                    <tr v-for="aeronave in this.items5"> 
                                        <td> {{aeronave.matricula}} </td>
                                        <td> {{aeronave.modelo}} </td>
                                        <td> {{sumar(aeronave.aehm)}} </td>                                      
                                       <td><b-form-radio  :value="aeronave.id">Seleccionar</b-form-radio ></td>
                                    </tr>
                                    <br/>
                                </tbody>
                            </table>
                            </b-form-radio-group>
                        </b-tab>
                        <b-tab title=" Piloto">
                            <b-form-radio-group id="piloto" v-model="form.piloto" name="piloto" required>
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
                                            <!--  <td> <label><input type="radio" v-model="form.piloto" :value="tripulante.id" required>Seleccionar</label> </td> -->
                                            <td>   <b-form-radio  :value="tripulante.id"  >Seleccionar</b-form-radio ></td>
                                        </tr>
                                        <br/>
                                    </tbody>
                                </table>
                            </b-form-radio-group>
                        </b-tab>

                        <b-tab title="Copiloto">
                            <b-form-radio-group id="copiloto" v-model="form.copiloto" name="copiloto" required>
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
                                        <td><b-form-radio  :value="tripulante.id">Seleccionar</b-form-radio ></td>
                                    </tr>
                                    <br/>
                                </tbody>
                            </table>    
                            </b-form-radio-group>       
                        </b-tab>

                        <b-tab title="Jefe de Cabina">
                            <b-form-radio-group id="jefecabina" v-model="form.jefac" name="jefecabina" required>
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
                                        <td> {{sumar(tripulante.jche)}} </td>
                                        <td> {{tripulante.jchp.cantidad}} </td>                                        
                                        <td><b-form-radio  :value="tripulante.id">Seleccionar</b-form-radio ></td>
                                    </tr>
                                    <br/>
                                </tbody>
                            </table>
                            </b-form-radio-group>
                        </b-tab>

                        <b-tab title="Sobrecargo">
                            <b-form-checkbox-group id="sobrecargos" name="jefecabina" v-model="form.sobrecargo">
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
                                        <td>   
                                           <b-form-checkbox :value="tripulante.id">Seleccionar</b-form-checkbox>                                           
                                        </td>                            
                                    </tr>
                                    <br/>
                                </tbody>
                            </table>
                            </b-form-checkbox-group>
                            
                        </b-tab>   
                    </b-tabs>
                    <div class=" col-sm-12 " >
                        <b-button type="submit" variant="primary">Guardar Vuelo</b-button>
                        <b-button type="reset" variant="secondary">Limpiar</b-button>                                    
                    </div>
            </div> <!-- cierre del v-if -->
        </div>
        </b-form>
       
           
       
        
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
            rutas: [],
            oculto: false,   
            items: null, 
            items2: null,   
            items3: null,
            items4: null,
            items5: null,
            data: null,   
            form:{
                piloto: null,
                copiloto: null,
                jefac: null,
                sobrecargo: [],
                aeronave: null,
            }
           
           
        }              
    },  
    
   
    created: function(){
       this.cargarRutas()
    },
    watch: {
        'sobrecargoC' (newVal, oldVal) {
            if (newVal.length === 4) {
               Vue.toasted.show("Escoge solo 3", {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                }); 
                this.form.sobrecargo.splice(3,1)
            } 
        }
    },
    computed: {
        sobrecargoC: function(){
            return this.form.sobrecargo
        },
        limite: function(){
            if(this.form.sobrecargo.length > 2){
                Vue.toasted.show("Escoge solo 3", {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                }); 
                return true;
            }
            return false;
        }
    },
    methods: {
        onSubmit (evt) {
            evt.preventDefault();           
            axios({
                method: 'post',
                url: '/vuelos/crear',
                data:{
                    fecha: this.fecha + " " + this.hora +":" + this.minutos +":" + this.segundos,
                    ruta: this.ruta,
                    piloto: this.form.piloto,
                    copiloto: this.form.copiloto,
                    jefac: this.form.jefac,
                    sobrecargo: this.form.sobrecargo,
                    aeronave: this.form.aeronave
                }
            }).then((response)=>{
                Vue.toasted.show(response.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                }); 
              
            }).catch((err)=>{
                console.log(err);
                 Vue.toasted.show('Ha ocurrido un error'.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                }); 
            }); 
        }, 
        onReset (evt) {
            evt.preventDefault();
                /* Reset our form values */
                this.form.piloto = null;
                this.form.name = '';
                this.form.food = null;
                this.form.sobrecargo = [];
                this.limite = false;
                /* Trick to reset/clear native browser form validation state */
                this.show = false;
                this.$nextTick(() => { this.show = true });
            },
       
        Buscar(){
            this.enviarFechas();
           
            
        },
        enviarFechas(){
            this.oculto = true;
            this.hora = parseInt(this.hora);
            this.minutos = parseInt(this.minutos);
            this.segundos = parseInt(this.segundos);
            if(this.hora < 10)
                this.hora = "0"+this.hora
            if(this.minutos < 10)
                this.minutos = "0"+this.minutos
            if(this.segundos< 10)
                this.segundos = "0"+this.segundos
            axios({
                method: 'post',
                url: '/vuelos/disponibilidad',
                data: {
                   fecha: this.fecha + " " + this.hora +":" + this.minutos +":" + this.segundos
                   
                }
                }).then((response) =>{
                    this.data = response.data;
                    console.log(this.data);
                    this.formatodatos();
                    
                
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
            this.items5 = [];
           
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
            for (var i= 0; i < this.data.aeronave.length; i++){
                this.items5.push(
                    this.data.aeronave[i], 
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
                if(data.data[i].ruta.estado === "activo")
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

