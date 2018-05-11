<template>
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">
        <h2 class="form-title">Contratación</h2>
      </div>
      <div class="card-body">
        <buscador formId="ContratacionForm" @aspirante="obtenerAspirante"></buscador>
        <hr>

        <form action="#" id="ContratacionForm">
          <!--Datos personales-->
          <personales :aspirante="aspirante"></personales>
          <hr>
          <!--Datos de habitacion-->
          <habitacion></habitacion>
          <hr>
          <!--Datos de contacto-->
          <contacto :aspirante="aspirante"></contacto>
          <hr>
          <!--Datos laborales-->
          <laborales></laborales>
          <hr>
          <!--Datos de nomina-->
          <nomina></nomina>
          <hr>

          <button type="submit" class="btn btn-success" @click.prevent="procesarEmpleado">
            <i class="fa fa-check"></i> Guardar y generar contrato
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import Personales from "./datos/Personales";
  import Habitacion from "./datos/Habitacion";
  import Contacto from "./datos/Contacto";
  import Buscador from "../Buscador";
  import Laborales from "./datos/Laborales";
  import Nomina from "./datos/Nomina";
  import VueSweetalert2 from 'vue-sweetalert2';

  Vue.use(VueSweetalert2);

  export default {
    name: "Contratacion",
    components: {Nomina, Laborales, Buscador, Contacto, Habitacion, Personales},
    data() {
      return {
        aspirante: '',
        datosPersonales: ''
      }
    },
    methods: {
      obtenerAspirante(aspirante) {
        this.aspirante = aspirante;
      },
      procesarEmpleado() {
        this.$swal({
          //position: 'top-end',
          type: 'warning',
          title: 'Se está trabajando en la funcionalidad de guardado...',
          showConfirmButton: true,
          //timer: 2000
        });
      }
    },
  }
</script>

<style scoped>

</style>