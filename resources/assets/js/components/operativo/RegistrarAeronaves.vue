<template>
    <div>
        <!-- Agregar -->
     <b-modal id="agregar"
             ref="modal"
             title="Registrar Aeronave"
            @hiden="resetModal"
            hide-footer
           >
    
    <b-form @submit.prevent="guardar()">
        <!--    <pre>{{modalInfo.content}}</pre>-->
        <div class="row">
        
         <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Matricula: </b></label>
              <b-form-input id="distancia"
                      type="text"
                      
                      required
                      v-model="form.matricula"
                      placeholder="Inserte Matricula">
              </b-form-input>
            </div>
          
          <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Modelo: </b></label>
              <b-form-input id="tarifa"
                      type="text"
                      required
                      v-model="form.modelo"
                      placeholder="Inserte  Modelo">
              </b-form-input>
            </div>
          
           <div class="form-group  col-sm-4">
              <label for="distancia"> <b>Capacidad: </b></label>
              <b-form-input id="tarifa"
                      type="text"
                      required
                      v-model="form.capacidad"
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
                   matricula: null,
                   modelo: null,
                   capacidad: null

                },           
            }
        },        
        methods: {
           guardar(){
               axios({
                method: 'post',
                url: '/aeronave',
                data: {
                    matricula: this.form.matricula,
                    modelo : this.form.modelo,
                    capacidad: this.form.capacidad
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




