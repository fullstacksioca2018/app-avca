<template>
    <div>
        <!-- Agregar -->
     <b-modal id="agregar"
             ref="modal"
             title="Registrar Sucursal"
            @hiden="resetModal"
            hide-footer
           >
    
    <b-form @submit.prevent="guardar()">
        <!--    <pre>{{modalInfo.content}}</pre>-->
        <div class="row">
        
         <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Nombre: </b></label>
              <b-form-input id="nombre"
                      type="text"
                      
                      required
                      v-model="form.Nombre"
                      placeholder="Inserte Matricula">
              </b-form-input>
            </div>
          
          <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Siglas: </b></label>
              <b-form-input id="tarifa"
                      type="text"
                      required
                      v-model="form.Siglas"
                      placeholder="Inserte  Modelo">
              </b-form-input>
            </div>
          
           <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Ciudad: </b></label>
              <b-form-input id="tarifa"
                      type="text"
                      required
                      v-model="form.Ciudad"
                      placeholder="Inserte  Capacidad">
              </b-form-input>
            </div>
     
        </div>
    
      <div class="text-center">
        <b-button type="submit" variant="primary" >Guardar</b-button>
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
                   Nombre: null,
                   Siglas: null,
                   Ciudad: null

                },           
            }
        },        
        methods: {
           guardar(){
               axios({
                method: 'post',
                url: '/sucursales',
                data: {
                    Nombre: this.form.Nombre,
                    Siglas : this.form.Siglas,
                    Ciudad: this.form.Ciudad
                }
                
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
           },           
            resetModal () {
               
            },
            onSubmit(){

            }              
        }
    }
</script>




