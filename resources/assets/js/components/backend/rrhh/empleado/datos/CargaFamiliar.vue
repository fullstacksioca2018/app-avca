<template>
  <div class="col-12">
    <h1 class="text-center">Actualizar Carga Familiar</h1>

    <div class="float-right">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargaFamiliarModal">
        <i class="fa fa-plus-square"></i> Familiar
      </button>
    </div>

    <table class="table table-striped">
      <thead>
      <tr>
        <th>Cédula</th>
        <th>Nombre y Apellido</th>
        <th>F. Nacimiento</th>
        <th>Sexo</th>
        <th>Parentesco</th>
        <th>&nbsp;</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="carga_familiar.length > 0" v-for="cf in carga_familiar" :key="cf.id">
        <td>{{ cf.cedula_beneficiario }}</td>
        <td>{{ cf.nombre }} {{ cf.apellido }}</td>
        <td>{{ cf.fecha_nacimiento }}</td>
        <td>{{ cf.genero }}</td>
        <td>{{ cf.parentesco }}</td>
        <td>
          <button class="btn btn-warning" @click.prevent="actualizarEstatus(cf.carga_familiar_id)">
            <i class="fa fa-ban"></i>
          </button>
        </td>
      </tr>
      </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="cargaFamiliarModal" tabindex="-1" role="dialog" aria-labelledby="cargaFamiliarModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cargaFamiliarModalLabel">Carga familiar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-header bg-info">Agregar Familiar</div>
              <div class="card-body">
                <form action="#" @submit.prevent="agregarCargaFamiliar" id="frmCargaFamiliar" method="post">
                  <div class="row">
                    <div class="col-md-6 offset-md-3">
                      <div class="form-group">
                        <label for="cedula_beneficiario">Cédula</label>
                        <input type="text" name="cedula_beneficiario" id="cedula_beneficiario" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="parentesco">Parentesco</label>
                        <select name="parentesco" id="parentesco" class="form-control">
                          <option value="" selected="selected">Seleccione</option>
                          <option value="hijos">Hijo</option>
                          <option value="padres">Padre</option>
                          <option value="conyugue">Conyugue</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="genero">Género</label>
                        <select name="genero" id="genero" class="form-control">
                          <option value="" selected="selected">Seleccione</option>
                          <option value="f">Femenino</option>
                          <option value="m">Masculino</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="empleado_id" :value="empleado.empleado_id">
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import VueSweetalert2 from 'vue-sweetalert2';
  Vue.use(VueSweetalert2);

  export default {
    name: "CargaFamiliar",
    props: ['empleado'],
    data() {
      return {
        carga_familiar: {}
      }
    },
    mounted() {
      this.obtenerCargaFamiliar();
    },
    methods: {
      obtenerCargaFamiliar() {
        axios.get('/rrhh/backend/perfil/obtener-carga-familiar', {
          params: {
            empleado_id: this.empleado.empleado_id
          }
        })
          .then(response => {
            console.log(response.data);
            this.carga_familiar = response.data;
          })
          .catch(error => {
            console.log(error)
          });
      },
      agregarCargaFamiliar() {
        let frmCargaFamiliar = document.getElementById('frmCargaFamiliar');
        let formData = new FormData(frmCargaFamiliar);
        axios.post('/rrhh/backend/perfil/agregar-carga-familiar', formData)
          .then(response => {
            console.log(response.data);

            $("#cargaFamiliarModal").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();//eliminamos el backdrop del modal

            this.$swal({
              type: 'success',
              title: 'Familiar registrado con éxito',
              showConfirmButton: true,
            });
            this.obtenerCargaFamiliar();
          })
          .catch(error => {
            this.$swal({
              type: 'warning',
              title: 'Ha ocurrido un error. Por favor intente nuevamente',
              showConfirmButton: true,
            });
          })
      },
      actualizarEstatus(cfId) {
        axios.put('/rrhh/backend/perfil/actualizar-estatus/' + cfId)
          .then(response => {
            console.log(response.data);
            this.$swal({
              type: 'success',
              title: 'Familiar inhabilitado con éxito.',
              showConfirmButton: true,
            });
            this.obtenerCargaFamiliar();
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

<style scoped>

</style>