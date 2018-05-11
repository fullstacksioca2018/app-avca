<template>
  <div>
    <button class="btn btn-outline-info" data-toggle="modal" data-target="#aspiranteEntrevistadoModal">
      <i class="fa fa-eye" aria-hidden="true"></i>
    </button>

    <div class="modal fade" id="aspiranteEntrevistadoModal" tabindex="-1" role="dialog" aria-labelledby="aspiranteEntrevistadoModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="aspiranteEntrevistadoModalLabel">Resumen de entrevista preliminar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
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
              <div v-for="cualidad in cualidades" class="col-md-2 text-center">
                <i class="fa fa-check fa-2x text-success" v-if="cualidad === entrevista.presentacion"></i>
              </div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Inteligencia efectiva</div>
              <div v-for="cualidad in cualidades" class="col-md-2 text-center">
                <i class="fa fa-check fa-2x text-success" v-if="cualidad === entrevista.inteligencia"></i>
              </div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Formación</div>
              <div v-for="cualidad in cualidades" class="col-md-2 text-center">
                <i class="fa fa-check fa-2x text-success" v-if="cualidad === entrevista.formacion"></i>
              </div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Experiencia</div>
              <div v-for="cualidad in cualidades" class="col-md-2 text-center">
                <i class="fa fa-check fa-2x text-success" v-if="cualidad === entrevista.experiencia"></i>
              </div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Facilidad de expresión</div>
              <div v-for="cualidad in cualidades" class="col-md-2 text-center">
                <i class="fa fa-check fa-2x text-success" v-if="cualidad === entrevista.facilidad_expresion"></i>
              </div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Habilidad para relacionarse</div>
              <div v-for="cualidad in cualidades" class="col-md-2 text-center">
                <i class="fa fa-check fa-2x text-success" v-if="cualidad === entrevista.habilidad"></i>
              </div>
            </div>
            <div class="row mb-3 align-items-center">
              <div class="col-md-2 text-left">Otros conocimientos</div>
              <div v-for="cualidad in cualidades" class="col-md-2 text-center">
                <i class="fa fa-check fa-2x text-success" v-if="cualidad === entrevista.otros"></i>
              </div>
            </div>

            <hr>
            <div class="row">
              <div class="col-12 text-left">
                <label>Entrevista:</label>
                <p>{{ entrevista.observaciones }}</p>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <button class="btn btn-outline-info" @click.prevent="cambiarEstatus(aspirante.aspirante_id)">Preseleccionar</button>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {EventBus} from "../event-bus";

  export default {
    name: "AspiranteEntrevistadoModal",
    props: ['aspirante'],
    data() {
      return {
        entrevista: '',
        aspirantes: [],
        cualidades: [
          'excelente', 'bueno', 'regular', 'bajo', 'deficiente'
        ]
      }
    },
    mounted() {
      this.obtenerDatosEntrevista();
    },
    methods: {
      obtenerDatosEntrevista() {
        axios.get('/rrhh/backend/obtener-datos-entrevista/' + this.aspirante.aspirante_id)
          .then(response => {
            console.log(response.data);
            this.entrevista = response.data;
          })
      },
      cambiarEstatus(aspirante_id) {
        axios.get('/rrhh/backend/cambiar-estatus/', {
          params: {
            estatus: 'seleccionados',
            aspirante_id: aspirante_id
          }
        })
          .then(response => {
            console.log(response.data);
            this.aspirantes = response.data;

            $("#aspiranteEntrevistadoModal").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();//eliminamos el backdrop del modal

            this.$swal({
              //position: 'top-end',
              type: 'success',
              title: 'Aspirante preseleccionado.',
              showConfirmButton: false,
              timer: 2000
            });

            EventBus.$emit('aspirantes', this.aspirantes);
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
  }
</script>

<style scoped>

</style>