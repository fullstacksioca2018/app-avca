<template>
  <div class="vacante">
    <div class="vacante__search">
      <h4 class="vacante__title">Vacante a consultar</h4>
      <form @submit.prevent="obtenerAspirantes" class="form-row">
        <div class="col-md-4">
          <div class="input-group row">
            <div class="input-group-prepend">
              <span class="input-group-text">Sucursal</span>
            </div>
            <select name="sucursal" id="sucursal" class="form-control" v-model="sucursal">
              <option :value="sucursal.sucursal_id" v-for="sucursal in sucursales">{{ sucursal.nombre | capitalize }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group row">
            <div class="input-group-prepend">
              <span class="input-group-text">Área</span>
            </div>
            <select name="area" id="area" class="form-control" @change="obtenerCargos" v-model="area">
              <option value="" selected="selected">Buscar en área</option>
              <option :value="area.area_id" v-for="area in areas">{{ area.nombre | capitalize }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group row">
            <div class="input-group-prepend">
              <span class="input-group-text">Cargo</span>
            </div>
            <select name="cargo" id="cargo" class="form-control" v-model="cargo">
              <option value="" selected="selected">Buscar en cargo</option>
              <option :value="cargo.cargo_id" v-for="cargo in cargos">{{ cargo.titulo | capitalize }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import {EventBus} from "../event-bus";

  export default {
    name: "VacanteFilter",
    data() {
      return {
        sucursal: null,
        area: null,
        cargo: null,
        sucursales: [],
        cargos: [],
        areas: [],
        aspirantes: [],
        estatus: 'registrados'
      }
    },
    created() {
      this.obtenerSucursales();
      this.obtenerAreas();
      EventBus.$on('estatus', (estatus) => {
        if (estatus != '') {
          this.estatus = estatus;
        }
      })
    },
    methods: {
      obtenerSucursales() {
        axios.get('/rrhh/backend/obtener-sucursales')
          .then(response => {
            this.sucursales = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      },
      obtenerAreas() {
        axios.get('/rrhh/backend/obtener-areas')
          .then(response => {
            this.areas = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      },
      obtenerCargos() {
        axios.get('/rrhh/backend/obtener-cargos/'+this.area)
          .then(response => {
            this.cargos = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      },
      obtenerAspirantes() {
        EventBus.$emit('estatus', this.estatus);
        if (!this.sucursal || !this.area || !this.cargo) {
          return;
        }
        axios.get('/rrhh/backend/obtener-aspirantes/', {
          params: {
            sucursal_id: this.sucursal,
            area_id: this.area,
            cargo_id: this.cargo,
            estatus: this.estatus
          }
        })
          .then(response => {
            console.log(response.data);
            this.aspirantes = response.data;
            EventBus.$emit('aspirantes', this.aspirantes);
          })
          .catch(error => {
            console.error(error)
          })
      }
    },
    filters: {
      capitalize: function (value) {
        if (!value) return '';
        value = value.toString();
        return value.charAt(0).toUpperCase() + value.slice(1);
      }
    }
  }
</script>

<style scoped>

</style>