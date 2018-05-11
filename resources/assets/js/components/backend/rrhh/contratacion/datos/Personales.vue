<template>
  <fieldset>
    <legend>Datos personales</legend>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="cedula">Cédula</label>
          <input type="text" name="cedula" id="cedula" class="form-control" v-model="aspirante.cedula" required readonly>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="nombres">Nombres</label>
          <input type="text" name="nombres" id="nombres" class="form-control" :value="aspirante.nombre" readonly>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="apellidos">Apellidos</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control" :value="aspirante.apellido" readonly>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <p class="font-weight-bold">Nacionalidad</p>
          <label>
            <input type="radio" name="nacionalidad" value="v" :checked="aspirante.nacionalidad === 'v'" disabled> V
          </label>
          <label class="ml-2">
            <input type="radio" name="nacionalidad" value="e" :checked="aspirante.nacionalidad === 'e'" disabled> E
          </label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <div class="input-group">
          <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" :value="aspirante.fecha_nacimiento">
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-calendar"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="estado_civil">Estado civil</label>
          <select name="estado_civil" id="estado_civil" class="form-control">
            <option value="" selected="selected">Seleccione</option>
            <option value="solter@">Solter@</option>
            <option value="casad@">Casad@</option>
            <option value="concubinato">Concubinato</option>
            <option value="divorciad@">Divorciad@</option>
            <option value="viud@">Viud@</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <label for="fecha_ingreso">Fecha de ingreso</label>
        <div class="input-group">
          <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control">
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-calendar"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <p class="font-weight-bold">Género</p>
          <label>
            <input type="radio" name="sexo" value="femenino" :checked="aspirante.sexo === 'f'"> F
          </label>
          <label class="ml-2">
            <input type="radio" name="sexo" value="masculino" :checked="aspirante.sexo === 'm'"> M
          </label>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-12">
        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto" class="form-control-file">
      </div>
    </div>

  </fieldset>
</template>

<script>
  export default {
    name: "Personales",
    props: ['aspirante'],
    data() {
      return {
        /*datosPersonales: {
          cedula: '',
          nombre: this.aspirante.nombre,
          apellido: this.aspirante.apellido,
          nacionalidad: this.aspirante.nacionalidad,
          fecha_nacimiento: this.aspirante.fecha_nacimiento,
          estado_civil: this.aspirante.estado_civil,
          fecha_ingreso: '',
          sexo: this.aspirante.sexo
        }*/
      }
    },
    methods: {
      /*obtenerDatosPersonales() {
        this.datosPersonales.cedula = this.aspirante.cedula;
        console.log('Componente Personales: ', this.datosPersonales.cedula);
        this.$emit('datosPersonales', this.datosPersonales);
      }*/
    },
  }
</script>

<style scoped>

</style>
