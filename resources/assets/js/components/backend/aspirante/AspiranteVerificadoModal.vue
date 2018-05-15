<template>
  <!-- Modal -->
  <div class="modal fade" ref="modal" id="aspiranteVerificadoModal" tabindex="-1" role="dialog" aria-labelledby="aspiranteVerificadoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="aspiranteVerificadoModalLabel">Convocatoria para entrevista preliminar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" v-if="errors.length !== 0">
            <ul class="list-unstyled">
              <li v-for="error in errors">{{ error[0] }}</li>
            </ul>
          </div>
          <form action="#" method="post" id="aspiranteVerificadoForm" @submit.prevent="enviarConvocatoria" novalidate>
            <div class="form-group">
              <label for="lugar">Lugar</label>
              <input type="text" name="lugar" id="lugar" class="form-control" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fecha">Fecha</label>
                  <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="hora">Hora</label>
                  <input type="time" name="hora" id="hora" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <p>Recaudos a consignar</p>
              <label for="certificado_medico" class="d-block">
                <input type="checkbox" name="recaudos[]" id="certificado_medico" value="Certificado Médico">
                Certificado Médico
              </label>
              <label for="titulo_grado" class="d-block">
                <input type="checkbox" name="recaudos[]" id="titulo_grado" value="Título de Grado">
                Título de Grado
              </label>
              <label for="prueba_psicotecnica" class="d-block">
                <input type="checkbox" name="recaudos[]" id="prueba_psicotecnica" value="Resultados de prueba psicotécnica">
                Resultados de prueba psicotécnica
              </label>
              <label for="rif" class="d-block">
                <input type="checkbox" name="recaudos[]" id="rif" value="RIF">
                RIF
              </label>
            </div>
            <input type="hidden" name="email" :value="emailVerificado">
            <input type="hidden" name="aspirante_id" :value="aspirante.aspirante_id">
            <input type="hidden" name="nombre" :value="aspirante.nombre + ' ' + aspirante.apellido">
            <button type="submit" class="btn btn-info">
              <i class="fa fa-envelope-o"></i> Enviar
            </button>
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
  import VueSweetalert2 from 'vue-sweetalert2';

  Vue.use(VueSweetalert2);

  export default {
    name: "AspiranteVerificadoModal",
    data() {
      return {
        emailVerificado: '',
        aspirante: '',
        errors: [],
        aspirantes: []
      }
    },
    mounted() {
      EventBus.$on('email-verificado', (aspirante) => {
        this.emailVerificado = aspirante.email;
        this.aspirante = aspirante;
      });
    },
    methods: {
      enviarConvocatoria() {
        let aspiranteVerificadoForm = document.getElementById('aspiranteVerificadoForm');
        let formData = new FormData(aspiranteVerificadoForm);
        axios.post('/rrhh/backend/enviar-convocatoria', formData)
          .then(response => {
            if (response.data.isValid === false) {
              this.errors = response.data.errors;
            } else {
              $('#lugar').val('');
              $('#fecha').val('');
              $('#hora').val('');
              $(':checkbox, :radio').prop('checked', false);

              this.$swal({
                //position: 'top-end',
                type: 'success',
                title: 'Convocatoria enviada exitosamente.',
                showConfirmButton: false,
                timer: 2000
              });

              console.log(response.data);
              this.aspirantes = response.data;

              EventBus.$emit('aspirantes', this.aspirantes);
            }
          })
          .catch(error => {
            console.log(error)
          });
      }
    },
  }
</script>

<style scoped>

</style>