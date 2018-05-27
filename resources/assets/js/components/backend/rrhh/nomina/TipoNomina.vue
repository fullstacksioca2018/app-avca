<template>
  <div class="form-group">
    <label for="nombre">Nómina</label>
    <select name="nombre" id="nombre" class="form-control">
      <option value="" selected="selected">Seleccione</option>
      <option :value="nomina.nomina_id" v-for="nomina in nominas" :key="nomina.id">{{ nomina.nombre }}</option>
    </select>
  </div>
</template>

<script>
  export default {
    name: "TipoNomina",
    data() {
      return {
        nominas: [],
      }
    },
    mounted() {
      this.obtenerNominas();
    },
    methods: {
      obtenerNominas() {
        axios.get('/rrhh/backend/nomina/obtener-nominas')
          .then(response => {
            console.log(response.data);
            this.nominas = response.data;
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
  }
</script>

<style scoped>

</style>