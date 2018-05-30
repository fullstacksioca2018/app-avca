<template>
  <div class="modal fade" id="aspiranteConvocadoModal" tabindex="-1" role="dialog" aria-labelledby="aspiranteConvocadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="aspiranteConvocadoModalLabel">Resumen de entrevista preliminar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="#" id="entrevistaForm" @submit.prevent="guardarEntrevista">
            <div class="row mb-3">
              <div class="col-md-2"></div>
              <div class="col-md-2">Excelente</div>
              <div class="col-md-2">Bueno</div>
              <div class="col-md-2">Regular</div>
              <div class="col-md-2">Bajo</div>
              <div class="col-md-2">Deficiente</div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Presentación personal</div>
              <div class="col-md-2"><input type="radio" name="presentacion" value="excelente"></div>
              <div class="col-md-2"><input type="radio" name="presentacion" value="bueno"></div>
              <div class="col-md-2"><input type="radio" name="presentacion" value="regular"></div>
              <div class="col-md-2"><input type="radio" name="presentacion" value="bajo"></div>
              <div class="col-md-2"><input type="radio" name="presentacion" value="deficiente"></div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Inteligencia efectiva</div>
              <div class="col-md-2"><input type="radio" name="inteligencia" value="excelente"></div>
              <div class="col-md-2"><input type="radio" name="inteligencia" value="bueno"></div>
              <div class="col-md-2"><input type="radio" name="inteligencia" value="regular"></div>
              <div class="col-md-2"><input type="radio" name="inteligencia" value="bajo"></div>
              <div class="col-md-2"><input type="radio" name="inteligencia" value="deficiente"></div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Formación</div>
              <div class="col-md-2"><input type="radio" name="formacion" value="excelente"></div>
              <div class="col-md-2"><input type="radio" name="formacion" value="bueno"></div>
              <div class="col-md-2"><input type="radio" name="formacion" value="regular"></div>
              <div class="col-md-2"><input type="radio" name="formacion" value="bajo"></div>
              <div class="col-md-2"><input type="radio" name="formacion" value="deficiente"></div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Experiencia</div>
              <div class="col-md-2"><input type="radio" name="experiencia" value="excelente"></div>
              <div class="col-md-2"><input type="radio" name="experiencia" value="bueno"></div>
              <div class="col-md-2"><input type="radio" name="experiencia" value="regular"></div>
              <div class="col-md-2"><input type="radio" name="experiencia" value="bajo"></div>
              <div class="col-md-2"><input type="radio" name="experiencia" value="deficiente"></div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Facilidad de expresión</div>
              <div class="col-md-2"><input type="radio" name="facilidad_expresion" value="excelente"></div>
              <div class="col-md-2"><input type="radio" name="facilidad_expresion" value="bueno"></div>
              <div class="col-md-2"><input type="radio" name="facilidad_expresion" value="regular"></div>
              <div class="col-md-2"><input type="radio" name="facilidad_expresion" value="bajo"></div>
              <div class="col-md-2"><input type="radio" name="facilidad_expresion" value="deficiente"></div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Habilidad para relacionarse</div>
              <div class="col-md-2"><input type="radio" name="habilidad" value="excelente"></div>
              <div class="col-md-2"><input type="radio" name="habilidad" value="bueno"></div>
              <div class="col-md-2"><input type="radio" name="habilidad" value="regular"></div>
              <div class="col-md-2"><input type="radio" name="habilidad" value="bajo"></div>
              <div class="col-md-2"><input type="radio" name="habilidad" value="deficiente"></div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Otros conocimientos</div>
              <div class="col-md-2"><input type="radio" name="otros" value="excelente"></div>
              <div class="col-md-2"><input type="radio" name="otros" value="bueno"></div>
              <div class="col-md-2"><input type="radio" name="otros" value="regular"></div>
              <div class="col-md-2"><input type="radio" name="otros" value="bajo"></div>
              <div class="col-md-2"><input type="radio" name="otros" value="deficiente"></div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group text-left">
                  <label for="observaciones">Observaciones</label>
                  <textarea name="observaciones" id="observaciones" cols="30" rows="5" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <input type="hidden" name="aspirante_id" :value="aspirante.aspirante_id">
            <input type="hidden" name="vacante" :value="vacante">
            <input type="hidden" name="estatus" value="convocados">
            <div class="row">
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {EventBus} from "../event-bus";  

  export default {
    name: "AspiranteConvocadoModal",
    data() {
      return {
        aspirante: '',
        aspirants: [],
        vacante: ''
      }
    },
    mounted() {
      EventBus.$on('aspirante-seleccionado', (aspirante, vacante) => {
        this.aspirante = aspirante;
        this.vacante = vacante
      });
    },
    methods: {
      guardarEntrevista() {
        let form = document.getElementById('entrevistaForm');
        let formData = new FormData(form);
        
        axios.post('/rrhh/backend/seleccion/guardar-entrevista', formData)
          .then(response => {
            console.log(response.data);
            this.aspirants = response.data;            

            $("#aspiranteConvocadoModal").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();//eliminamos el backdrop del modal

            this.$swal({
              //position: 'top-end',
              type: 'success',
              title: 'Chequeo del aspirante exitoso',
              showConfirmButton: false,
              timer: 2000
            });            

            EventBus.$emit('aspirantes', this.aspirants[0]);
          })
          .catch(error => {
            console.log(error);
          })
      }
    },
  }
</script>

<style scoped>

</style>