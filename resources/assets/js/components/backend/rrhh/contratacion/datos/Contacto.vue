<template>
  <fieldset>
    <legend>Datos de contacto</legend>
    <div class="row mb-3">
      <div class="col-md-3">
        <label for="telefono_fijo">Teléfono fijo</label>
        <div class="input-group">
          <input type="tel" pattern="\d" class="form-control" name="telefono_fijo" id="telefono_fijo" placeholder="Teléfono fijo" :value="aspirante.telefono_fijo" readonly>
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-phone"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <label for="telefono_movil">Teléfono móvil</label>
        <div class="input-group">
          <input type="tel" name="telefono_movil" id="telefono_movil" class="form-control" placeholder="Teléfono movil" :value="aspirante.telefono_movil" readonly>
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-mobile"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <label for="email">Correo electrónico</label>
        <div class="input-group">
          <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" :value="aspirante.email" readonly>
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-envelope"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <p class="font-weight-bold">¿Posee alguna discapacidad?</p>
          <label>
            <input type="radio" name="discapacidad" value="si" v-model="discapacidad"> Si
          </label>
          <label class="ml-3">
            <input type="radio" name="discapacidad" value="no" v-model="discapacidad"> No
          </label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <select name="tipo_discapacidad" id="tipo_discapacidad" class="form-control" :disabled="toggleDiscapacidad">
            <option value="" selected="selected">Seleccione</option>
            <option value="trastorno del habla y lenguaje">Trastorno del habla y lenguaje</option>
            <option value="visual">Visual</option>
            <option value="motriz">Motriz</option>
            <option value="auditiva">Auditiva</option>
          </select>
        </div>
      </div>
    </div>
  </fieldset>
</template>

<script>
  export default {
    name: "Contacto",
    props: ['aspirante'],
    data() {
      return {
        discapacidad: '',
      }
    },
    computed: {
      toggleDiscapacidad: function() {
        if (this.discapacidad == 'si') return false;
        else return true;
      }
    },
  }
</script>

<style scoped>

</style>