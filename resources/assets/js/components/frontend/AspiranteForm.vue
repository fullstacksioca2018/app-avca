<template>
  <div class="row">
    <div class="col-12">
      <div v-if="errs.errors">
        <div class="alert alert-danger">
          <p v-for="err in errs.errors" v-text="err[0]"></p>
        </div>
      </div>
      <div v-if="message">
        <div class="alert alert-success">
          <span v-text="message"></span>
        </div>
      </div>
      <div id="aspiranteForm" class="aspirante-frm">
        <header class="header-form d-flex">
          <div class="header-form__text ml-3">
            <h4>Alas de Venezuela</h4>
            <h5>Registro de aspirantes</h5>
          </div>
        </header>
        <hr>
        <form @submit.prevent="registrarAspirante" id="aspiranteFrm" enctype="multipart/form-data" novalidate>
          <fieldset>
            <legend>Datos personales</legend>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" name="nombre" id="name" class="form-control" placeholder="Ingrese su nombre" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="lastname">Apellido</label>
                  <input type="text" name="apellido" id="lastname" class="form-control" placeholder="Ingrese su apellido" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cedula">Documento de identidad</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <select name="nacioanlidad" id="nacionalidad" class="form-control">
                        <option value="v">V</option>
                        <option value="e">E</option>
                      </select>
                    </div>
                    <input type="text" name="cedula" id="cedula" class="form-control" maxlength="8" placeholder="Ingrese su cédula" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <div class="input-group">
                  <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>
                <span class="mr-3">Sexo:</span>
                <input type="radio" name="sexo" value="f"> F
                <input type="radio" name="sexo" value="m"> M
              </label>
            </div>
          </fieldset>
          <hr>

          <fieldset>
            <legend>Datos de contacto</legend>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="telefono_fijo">Teléfono fijo</label>
                  <input type="tel" name="telefono_fijo" id="telefono_fijo" class="form-control" placeholder="Ingrese su teléfono fijo" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="telefono_movil">Teléfono móvil</label>
                  <input type="tel" name="telefono_movil" id="telefono_movil" class="form-control" placeholder="Ingrese su teléfono movil" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">Correo electrónico</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su correo electrónico" required>
                  <span v-show="errors.has('email')" class="text-muted text-danger">{{ errors.first('email') }}</span>
                </div>
              </div>
            </div>
          </fieldset>
          <hr>
          <fieldset>
            <div class="form-group">
              <label for="curriculum">Resumen curricular <i class="far fa-file-pdf"></i></label>
              <input type="file" name="curriculum" id="curriculum" class="form-control-file">
            </div>
          </fieldset>

          <input type="hidden" name="vacante_id" v-model="vacante_id">
          <div class="form-group">
            <input type="submit" value="Enviar" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "AspiranteForm",
    props: ['vacante_id'],
    data() {
      return {
        errs: [],
        message: ''
      }
    },
    methods: {
      registrarAspirante() {
        let aspiranteForm = document.getElementById('aspiranteFrm');
        let formData = new FormData(aspiranteForm);

        axios.post('/registrar-aspirante', formData)
          .then(res => {
            this.message = res.data.message;
            Object.keys(this.data.form).forEach((key, index) => {
              this.data.form[key] = '';
            })
          })
          .catch(error => {
            console.error(error.response.data.errors);
            this.errs = error.response.data;
            console.log(this.errs.errors);
          })
      }
    },
  }
</script>

<style scoped>

</style>