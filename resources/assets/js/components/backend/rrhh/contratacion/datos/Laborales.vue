<template>
  <fieldset>
    <legend>Datos laborales</legend>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="sucursal">Sucursal</label>
          <select name="sucursal" id="sucursal" class="form-control">
            <option value="" selected="selected">Seleccione</option>
            <option :value="sucursal.sucursal_id" v-for="sucursal in sucursales" :key="sucursal.sucursal_id">{{ sucursal.nombre }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="departamento">Departamento</label>
          <select name="departamento" id="departamento" class="form-control">
            <option value="" selected="selected">Seleccione</option>
            <option :value="departamento.id" v-for="departamento in departamentos" :key="departamento.id">{{ departamento.descripcion }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="cargo">Cargo</label>
          <select ref="cargo" name="cargo" id="cargo" class="form-control" @change="obtenerTabuladorSalarial" v-model="cargo">
            <option value="" selected="selected">Seleccione</option>
            <option :value="{cargo_id: cargo.cargo_id, tabulador_salarial: cargo.tabulador_salarial_id}" v-for="cargo in cargos" :key="cargo.id">{{ cargo.titulo }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="nivel_academico">Nivel Académico</label>
          <select name="nivel_academico" id="nivel_academico" class="form-control" v-model="nivel_academico" @change="obtenerProfesiones">
            <option value="" selected="selected">Seleccione</option>
            <option value="bachiller">Bachiller</option>
            <option value="tsu">TSU</option>
            <option value="profesional">Profesional</option>
            <option value="especialista 1">Especialista 1</option>
            <option value="especialista 2">Especialista 2</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="profesion">Profesión</label>
          <select name="profesion" id="profesion" class="form-control">
            <option value="" selected="selected">Seleccione</option>
            <option :value="profesion.id" v-for="profesion in profesiones">{{ profesion.titulo }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="condicion_laboral">Condición laboral</label>
          <select name="condicion_laboral" id="condicion_laboral" class="form-control">
            <option value="" selected="selected">Seleccione</option>
            <option value="suplente">Suplente</option>
            <option value="fijo">Fijo</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="tipo_horario">Tipo de horario</label>
          <select name="tipo_horario" id="tipo_horario" class="form-control">
            <option value="" selected="selected">Seleccione</option>
            <option value="fijo">Fijo</option>
            <option value="rotativo">Rotativo</option>
          </select>
        </div>
      </div>
    </div>
  </fieldset>
</template>

<script>
  import {EventBus} from '../../../event-bus';

  export default {
    name: "Laborales",
    data() {
      return {
        sucursales: [],
        departamentos: [],
        cargos: [],
        profesiones: [],
        nivel_academico: '',
        cargo: '',
        tabulador: '',
      }
    },
    mounted() {
      this.obtenerSucursales();
      this.obtenerDepartamentos();
      this.obtenerCargos();
    },
    methods: {
      obtenerSucursales() {
        axios.get('/rrhh/backend/contratacion/obtener-sucursales')
          .then((response) => {
            this.sucursales = response.data;
          });
      },
      obtenerDepartamentos() {
        axios.get('/rrhh/backend/contratacion/obtener-departamentos')
          .then((response) => {
            this.departamentos = response.data;
          });
      },
      obtenerCargos() {
        axios.get('/rrhh/backend/contratacion/obtener-cargos')
          .then((response) => {
            this.cargos = response.data;
          });
      },
      obtenerProfesiones() {
        console.log(this.nivel_academico)
        axios.get('/rrhh/backend/contratacion/obtener-profesiones', {
          params: {
            nivel_academico: this.nivel_academico
          }
        })
          .then((response) => {
            this.profesiones = response.data;
          });
      },
      obtenerTabuladorSalarial() {
        axios.get('/rrhh/backend/contratacion/obtener-tabulador', {
          params: {
            tabulador_salarial_id: this.cargo.tabulador_salarial
          }
        })
          .then((response) => {
            this.tabulador = response.data;
            EventBus.$emit('tabulador-salarial', response.data);
          });
      },
    },
  }
</script>

<style scoped>

</style>