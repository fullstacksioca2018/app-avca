<template>
  <div class="owl-carousel owl-theme">
    <div class="item" v-for="area in areas">
      <div class="card">
        <div class="card-header">{{ area.nombre }}</div>
        <img :src="area.foto" :alt="area.nombre" class="card-img-top" style="flex: 1 1 100%;">
        <div class="card-img-overlay d-flex align-items-end justify-content-center">
          <p class="card-text">
            <a href="#" class="btn btn-lg btn-block btn-success">
              <i class="fa fa-plus"></i>
              Información
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Oportunidades",
    data() {
      return {
        areas: []
      }
    },
    methods: {
      obtenerAreas() {
        axios.get('/rrhh/backend/obtener-areas')
          .then(response => {
            this.areas = response.data;
            console.log(response.data);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
  }
</script>

<style scoped>

</style>