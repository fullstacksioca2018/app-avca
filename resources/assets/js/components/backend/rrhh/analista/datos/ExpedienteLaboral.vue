<template>
  <div class="col-12">
    <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#expedienteModal">
      <i class="fas fa-file-alt"> </i>  Agregar documento
    </button>

    <div class="clearfix"></div>

    <div class="row py-3" v-if="expedientes.length > 0">
      <article class="col-md-6 expediente" v-for="expediente in expedientes" :key="expediente.id">
        <div class="row">
          <div class="col-md-6 col-lg-3 text-center">
            <h4>N° oficio <br> {{ expediente.num_oficio }}</h4>
            <div class="soporte_pdf">
              <a :href="ruta +'/storage/empleados/'+ empleado.cedula + '/expediente/' + expediente.soporte_pdf">
                <i class="fa fa-file-pdf-o fa-4x"></i>
              </a>
            </div>
            <span>
              <i class="fa fa-calendar"></i> {{ expediente.fecha }}
            </span>
          </div>
          <div class="col-md-6 col-lg-9">
            <h4>Descripción</h4>
            <p>{{ expediente.descripcion }}</p>
            <div class="row">
              <div class="col-md-6">
                <h4>Fecha inicio</h4>
                <span><i class="fa fa-calendar"></i> {{ expediente.fecha_inicio }}</span>
              </div>
              <div class="col-md-6">
                <h4>Fecha final</h4>
                <span><i class="fa fa-calendar"></i> {{ expediente.fecha_final }}</span>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>

    <!--inicio del modal igresar oficio-->
    <div class="modal fade" id="expedienteModal" tabindex="-1" role="dialog" aria-labelledby="expedienteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title" id="titulo">Agregar Oficio</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form action="#" method="post" @submit.prevent="guardarExpediente" id="frmExpediente">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="num_oficio">Número de oficio</label>
                    <input type="text" name="num_oficio" id="num_oficio" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="tipo_oficio">Tipo de oficio</label>
                  <select name="tipo_oficio" id="tipo_oficio" class="form-control">
                    <option value="" selected="selected">Seleccione</option>
                    <option :value="to" v-for="to in tipo_oficio" :key="to.id">{{ to }}</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fecha_inicio">Fecha de inicio <i class="fa fa-calendar"></i></label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fecha_final">Fecha de finalización <i class="fa fa-calendar"></i></label>
                    <input type="date" name="fecha_final" id="fecha_final" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="soporte_pdf">Anexar soporte</label>
                    <input type="file" name="soporte_pdf" id="soporte_pdf" class="form-control">
                  </div>
                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
              <input type="hidden" name="empleado_id" :value="empleado.empleado_id">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "ExpedienteLaboral",
    props: ['empleado', 'ruta'],
    data() {
      return {
        expedientes: [],
        tipo_oficio: [
          'amonestaciones',
          'reconocimientos',
          'formacion',
          'nombramiento',
          'accidente laboral',
          'licencias',
          'reposos médicos',
          'postparto'
        ]
      }
    },
    mounted() {
      this.obtenerExpedientes();
    },
    methods: {
      obtenerExpedientes() {
        axios.get('/rrhh/backend/perfil/obtener-expedientes/' + this.empleado.empleado_id)
          .then(response => {
            console.log(response.data);
            this.expedientes = response.data;
          })
          .catch(error => {
            console.log(error);
          })
      },
      guardarExpediente() {
        let frmExpediente = document.getElementById('frmExpediente');
        let formData = new FormData(frmExpediente);

        axios.post('/rrhh/backend/perfil/guardar-expediente', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
          .then(response => {
            console.log(response.data);
            $("#expedienteModal").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();//eliminamos el backdrop del modal

            this.$swal({
              type: 'success',
              title: 'Expediente registrado con éxito.',
              showConfirmButton: true,
            });

            this.obtenerExpedientes();
          })
          .catch(error => {
            console.log(error);
            this.$swal({
              type: 'warning',
              title: 'Ha ocurrido un error. Por favor intente nuevamente',
              showConfirmButton: true,
            });
          })
      }
    },
  }
</script>

<style scoped lang="scss">
.expediente {
  border: 2px solid #ccc;
  border-radius: 8px 8px 0 0;
  padding: 0.5rem;
  i {
    color: crimson;
  }
  h4 {
    font-weight: 600;
    font-size: 16px;
  }
  p, span {
    font-size: 14px;
  }
}
</style>