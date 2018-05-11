<template>
  <ul class="nav flex-column">
    <li
        class="nav-item"
        v-for="aspirante in aspirantes"
        :key="aspirante.id">
      <a href="#" class="nav-link" @click="obtenerAspiranteInfo(aspirante)">
        {{ aspirante.nombre }} {{ aspirante.apellido }}
      </a>
    </li>
  </ul>
</template>

<script>
  export default {
    name: "Contratables",
    props: {
      aspirantes: {
        type: Array,
        default: []
      },
    },
    methods: {
      obtenerAspiranteInfo(aspirante) {
        // axios.get('/rrhh/backend/contratacion/obtener-aspirante-info/' + aspirante.aspirante_id)
        axios.get('/rrhh/backend/contratacion/contratacion', {
          params: {
            aspirante_id: aspirante.aspirante_id
          }
        })
          .then(response => {
            console.log(response.data);
            this.$emit('aspirante', response.data);
            this.aspirantes.splice(0);
          })
          .catch(error => {
            console.log(error)
          });
      }
    },
  }
</script>

<style scoped>
.flex-column {
  background-color: #fff;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  position: absolute;
  width: 90%;
  z-index: 9;
}
</style>