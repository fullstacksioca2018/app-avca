<template>
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="input-group">
        <input type="search" name="search" id="search" :placeholder="placeholder" class="form-control" v-model="search">
        <div class="input-group-append">
        <button type="button" class="btn btn-info" @click.prevent="obtenerEmpleado">
          <i class="fa fa-search"></i>
        </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from "./event-bus";

export default {
  name: "Buscador",
  data() {
    return {
      search: null,
      placeholder: "Ingrese cédula del empleado",
      empleado: null
    };
  },
  methods: {
    obtenerEmpleado() {
      axios
        .get("/rrhh/backend/perfil/obtener-empleado", {
          params: {
            cedula: this.search
          }
        })
        .then(response => {
          //console.log(response.data);
          this.empleado = response.data;          
          EventBus.$emit("empleado", this.empleado);
        });
    }
  }
};
</script>

<style scoped>
  
</style>