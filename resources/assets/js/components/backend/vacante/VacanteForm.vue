<template>
  <div class="col-12">
    <div v-if="response">
      <div class="alert alert-success">
        {{ response.message }}
      </div>
    </div>
    <div class="card">
      <div class="card-header bg-info-gradient">
        <h3 class="card-title">Registrar una vacante</h3>
      </div>
      <div class="card-body">
        <form @submit.prevent="publicarVacante" id="vacanteForm" class="form-horizontal">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="sucursal">Sucursal</label>
                <select name="sucursal" id="sucursal" class="form-control">
                  <option value="" selected="selected">Seleccione</option>
                  <option :value="sucursal.sucursal_id" v-for="sucursal in sucursales">{{ sucursal.nombre | capitalize }}</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="area">Áreas</label>
                <select name="area" id="area" class="form-control" @change="obtenerCargos" v-model="area">
                  <option value="" selected="selected">Seleccione</option>
                  <option :value="area.area_id" v-for="area in areas">{{ area.nombre | capitalize }}</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="cargo">Cargo</label>
                <select name="cargo" id="cargo" class="form-control">
                  <option value="" selected="selected">Seleccione</option>
                  <option :value="cargo.cargo_id" v-for="cargo in cargos">{{ cargo.titulo | capitalize }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" value="Publicar" class="btn btn-info">
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "VacanteForm",
    data() {
      return {
        area: 0,
        sucursales: [],
        cargos: [],
        areas: [],
        response: ''
      }
    },
    created() {
      this.obtenerSucursales();
      this.obtenerAreas();
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
      publicarVacante() {
        let form = document.getElementById('vacanteForm');
        let formData = new FormData(form);
        axios.post('/rrhh/backend/vacante/publicar-vacante', formData)
          .then(response => {
            this.response = response.data;
          });
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