<template>
  <div class="aspirantes__filter pt-3">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a href="#" class="nav-link" @click.prevent="aspirantesPorEstatus('registrados')">Registrados</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" @click.prevent="aspirantesPorEstatus('verificados')">Verificados</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" @click.prevent="aspirantesPorEstatus('convocados')">Convocados</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" @click.prevent="aspirantesPorEstatus('entrevistados')">Entrevistados</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" @click.prevent="aspirantesPorEstatus('seleccionados')">Seleccionados</a>
      </li>
    </ul>
  </div>
</template>

<script>
  import {EventBus} from "../event-bus";
  export default {
    name: "AspiranteStatus",
    data() {
      return {
        aspirantes: [],
      }
    },
    methods: {
      aspirantesPorEstatus(estatus) {
        EventBus.$emit('estatus', estatus);
        axios.get('/rrhh/backend/obtener-aspirantes-estatus/' + estatus)
          .then(response => {
            console.log(response.data)
            this.aspirantes = response.data;
            EventBus.$emit('aspirantes', this.aspirantes)
          })
      }
    },
  }
</script>

<style scoped>

</style>