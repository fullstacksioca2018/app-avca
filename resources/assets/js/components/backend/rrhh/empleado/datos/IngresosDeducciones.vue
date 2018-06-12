<template>
  <div>
    <form action="#" @submit.prevent="procesarIngresosDeducciones" id="frmIngresosDeducciones" method="post">
      <div class="row form-group">
        <div class="col-md-6">
          <h4>Asignaciones</h4>
          <label
            :for="slugify(concepto.descripcion)"
            v-for="concepto in conceptos"
            :key="concepto.id"
            v-if="concepto.tipo_concepto.charAt(0) !== '5'"
            class="d-block">
            <input
              type="checkbox"
              name="asignaciones[]"
              :id="slugify(concepto.descripcion)"
              :value="concepto.concepto_id"
              :checked="concepto.estatus !== null"
            >
            {{ concepto.tipo_concepto }} {{ concepto.descripcion }}
          </label>
        </div>

        <div class="form-group">
          <h4>Deducciones</h4>
          <label
            :for="slugify(concepto.descripcion)"
            v-for="concepto in conceptos"
            :key="concepto.id"
            v-if="concepto.tipo_concepto.charAt(0) === '5'"
            class="d-block">
            <input
              type="checkbox"
              name="deducciones[]"
              :id="slugify(concepto.descripcion)"
              :value="concepto.concepto_id"
              :checked="concepto.estatus !== null"
            >
            {{ concepto.tipo_concepto }} {{ concepto.descripcion }}
          </label>
        </div>
      </div>
      <div class="row form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>

      <input type="hidden" name="empleado_id" :value="empleado.empleado_id">
    </form>
  </div>
</template>

<script>
  import VueSweetalert2 from 'vue-sweetalert2';
  Vue.use(VueSweetalert2);

  export default {
    name: "IngresosDeducciones",
    props: ['empleado'],
    data() {
      return {
        conceptos: [],
      }
    },
    mounted() {
      this.obtenerConceptos();
    },
    methods: {
      obtenerConceptos() {
        axios.get('/rrhh/backend/perfil/obtener-conceptos')
          .then(response => {
            console.log(response.data);
            this.conceptos = response.data;
          })
      },
      procesarIngresosDeducciones() {
        let frmIngresosDeducciones = document.getElementById('frmIngresosDeducciones');
        let formData = new FormData(frmIngresosDeducciones);

        axios.post('/rrhh/backend/perfil/guardar-ingresos-deducciones', formData)
          .then(response => {
            console.log(response.data);
            this.$swal({
              //position: 'top-end',
              type: 'success',
              title: 'Conceptos registrados exitosamente.',
              showConfirmButton: true,
              //timer: 2000
            });
          })
          .catch(error => {
            console.log(error)
            this.$swal({
              //position: 'top-end',
              type: 'warning',
              title: 'Ha ocurrido un error. Intente nuevamente.',
              showConfirmButton: true,
              //timer: 2000
            });
          })
      },
      // convierte una cadena a formato slug
      slugify: function (cadena) {
        return cadena
          .toString()
          .trim()
          .toLowerCase()
          .replace(/\s+/g, "-")
          .replace(/[^\w\-]+/g, "")
          .replace(/\-\-+/g, "-")
          .replace(/^-+/, "")
          .replace(/-+$/, "");
      }
    },
  }
</script>

<style scoped>

</style>