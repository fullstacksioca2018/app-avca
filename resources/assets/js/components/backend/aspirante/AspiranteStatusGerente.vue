<template>
  <div class="aspirantes__filter pt-3">    
    <ul class="nav nav-pills justify-content-center">      
      <li class="nav-item">
        <a href="#" :class="status === 'entrevistados' ? 'nav-link active' : 'nav-link'" @click.prevent="aspirantesPorEstatus('entrevistados')">Entrevistados</a>
      </li>
      <li class="nav-item">
        <a href="#" :class="status === 'seleccionados' ? 'nav-link active' : 'nav-link'" @click.prevent="aspirantesPorEstatus('seleccionados')">Seleccionados</a>
      </li>
    </ul>
  </div>
</template>

<script>
  import {EventBus} from "../event-bus";
  export default {
    name: "AspiranteStatus",
    props: ['vacante', 'estatus'],
    data() {
      return {
        aspirantes: [],
        status: 'entrevistados',
      }
    },
    methods: {
      aspirantesPorEstatus(estatus) {
        let loader = this.$loading.show();        
        axios.get('/rrhh/backend/seleccion/aspirantes-estatus', {
          params: {
            vacante: this.vacante,
            estatus: estatus
          }
      })
        .then((response) => {
          console.log(response.data)
          this.aspirantes = response.data[0];
          this.status = response.data[1];
          loader.hide();
          EventBus.$emit('aspirantes', this.aspirantes)
          EventBus.$emit('estatus', this.status);
        })
      },
    },
  }
</script>

<style scoped>

</style>