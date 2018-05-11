<template>
    <div>
        <!-- Agregar -->
     <b-modal id="agregar"
             ref="modal"
             title="Registrar Ruta"
            @hiden="resetModal"
           >
    
    <b-form @submit.prevent="guardar()">
       <!--    <pre>{{modalInfo.content}}</pre>-->
       <div class="row">
          <div class="form-group col-sm-1 "></div>
          <div class="col-sm-12">
            <label for="distancia"> <b> Origen: </b></label>
           <multiselect v-model="form.origen" :options="origenes" selectLabel="Seleccionar" deselectLabel="Eliminar" selectedLabel="Seleccionado" placeholder="Seleccione el Origen" label="nombre" track-by="nombre"></multiselect>
          </div>
          <div class="form-group col-sm-1 "></div>
          <div class="col-sm-12">
            <label for="distancia"> <b> Destino: </b></label>
           <multiselect v-model="form.destino" :options="destinos" selectLabel="Seleccionar" deselectLabel="Eliminar" selectedLabel="Seleccionado" placeholder="Seleccione el Origen" label="nombre" track-by="nombre"></multiselect>
          </div>
          
       
           <div class="form-group col-sm-1 "></div>
        </div>
      <div class="row"><p></p></div>
      <div class="row">
          <div class="form-group col-sm-1 "></div>
          <div class="col-sm-5">
            <label for="distancia"> <b> Inserte Nueva Distancia: </b></label>
            <b-form-input id="distancia"
                      type="text"
                      required
                      v-model="form.distancia"
                      placeholder="Inserte Nueva Distancia">
            </b-form-input>
          </div>
          
         <div class="col-sm-5">
           <label for="distancia"> <b> Inserte Nueva Tarifa: </b></label>
            <b-form-input id="tarifa"
                          type="text"
                          required
                          v-model="form.tarifa"
                          placeholder="Inserte Nueva Tarifa">
            </b-form-input>
          </div>
           <div class="form-group col-sm-1 "></div>
        </div>
      <div class="row"><p></p></div>
      <div class="row text-center"><div class="col-sm-12 " ><label for="duracion" class="text-center"> <b> Tiempo de Vuelo: </b> </label></div></div>   
      <div class="row col-sm-12 " id="duracion">
      <div class="form-group col-sm-2 "></div>
      <div class="col-sm-3 ">
      <span class="help-block"> Horas </span>
      <b-form-input type="number" min="0" max="24" class="form-control" id="ccyear" v-model="form.duracion.HH"></b-form-input> 
      
      </div>
     
      <div class="form-group col-sm-3 ">
        <span class="help-block"> Minutos </span>
        <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" v-model="form.duracion.mm"></b-form-input>
      </div>
       
      <div class="form-group col-sm-3 ">
        <span class="help-block"> Segundos </span>
        <b-form-input type="number" min="0" max="60" class="form-control" id="ccyear" v-model="form.duracion.ss"></b-form-input>
      </div>
     
    </div>
      <div class="text-center">
        <b-button type="submit" variant="primary" >Actualizar</b-button>
      </div>
      
      
    </b-form>
  
    </b-modal>
    </div>
</template>
<script>

    import multiselect from 'vue-multiselect'
    import {EventBus} from './event-bus.js'
    export default {
        watch:{
          
        },

        components: {
            multiselect
        },
   
        data(){
            return {
                form: {
                   origen:{
                       id: null,
                       nombre: null,
                   },
                   destino:{
                       id: null,
                       nombre: null,
                   },
                   distancia: null,
                   duracion: {
                       HH: null,
                       mm: null,
                       ss: null
                   },
                   tarifa: null,
                },
                sucursales: [],
               
              
      origenes: [
       
                                       
      ],
      destinos: [

      ],
                
            }
        },
        created: function(){
            this.CargarSucursales();
        },
        methods: {
           guardar(){
               axios({
                method: 'post',
                url: '/sucursales',
                data: this.form
                
               }).then((response)=>{
                   
                Vue.toasted.show(response.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                });
                EventBus.$emit('actualizartabla',true);
               }).catch((err) =>{

               });
           },
            CargarSucursales(){
                axios({
                    method: 'get',
                    url: '/sucursales/all'       
                }).then((response) =>{
                    this.formatosucursal(response);
                }).catch((err)=>{
                    Vue.toasted.show('Ha ocurrido un error', {
                        theme: "primary", 
	                    position: "bottom-right",  
	                    duration : 2000
                    });
                    console.log(err);
                });
            },
            resetModal () {
               
            },
            onSubmit(){

            },
            formatosucursal(data){
                //Anadir datos
                  console.log(data);
                for (var i= 0; i < data.data.length; i++){
                    this.origenes.push({
                        id: data.data[i].id,
                        nombre: data.data[i].nombre
                    });
                    this.destinos.push({
                        id: data.data[i].id,
                        nombre: data.data[i].nombre
                    });
                    this.sucursales.push({
                        id: data.data[i].id,
                        nombre: data.data[i].nombre
                    });
                }
               
                console.log(this.options);
            }
           
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"> </style>



