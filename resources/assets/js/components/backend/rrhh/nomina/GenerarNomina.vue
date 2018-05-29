<template>
  <div>
    <form action="#" id="frmNomina" @submit.prevent="procesarNomina">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label for="nombre">Nómina</label>
            <select name="nombre" id="nombre" class="form-control" v-model="chkNomina" required>
              <option value="" selected="selected">Seleccione</option>
              <option :value="nomina.nomina_id" v-for="nomina in nominas" :key="nomina.id">{{ nomina.nombre }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4 offset-md-1">
          <div class="form-group">
            <h4>Asignaciones</h4>
            <div
                class="custom-control custom-checkbox"
                v-for="concepto in conceptos"
                :key="concepto.id"
                v-if="concepto.tipo_concepto.charAt(0) !== '5'"
            >
              <input type="checkbox" name="asignaciones[]" :id="slugify(concepto.descripcion)" class="custom-control-input" :value="concepto.concepto_id" v-model="chkConceptos">
              <label class="custom-control-label" :for="slugify(concepto.descripcion)">{{ concepto.tipo_concepto }} {{ concepto.descripcion }}</label>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <h4>Deducciones</h4>
            <div
                class="custom-control custom-checkbox"
                v-for="concepto in conceptos"
                :key="concepto.id"
                v-if="concepto.tipo_concepto.charAt(0) === '5'"
            >
              <input type="checkbox" name="deducciones[]" :id="slugify(concepto.descripcion)" class="custom-control-input" :value="concepto.concepto_id" v-model="chkConceptos">
              <label class="custom-control-label" :for="slugify(concepto.descripcion)">{{ concepto.tipo_concepto }} {{ concepto.descripcion }}</label>
            </div>
          </div>
        </div>
      </div>
      <div class="row form-group">
        <button type="submit" class="btn btn-primary">Generar nómina</button>
      </div>
    </form>
  </div>
</template>

<script>
  import VueSweetalert2 from 'vue-sweetalert2';
  Vue.use(VueSweetalert2);

  export default {
    name: "GenerarNomina",
    data() {
      return {
        conceptos: [],
        chkConceptos: [],
        nominas: [],
        chkNomina: ''
      }
    },
    mounted() {
      this.obtenerConceptos();
      this.obtenerNominas();
    },
    methods: {
      procesarNomina() {
        let frmNomina = document.getElementById('frmNomina');
        let formData = new FormData(frmNomina);
        axios.post('/rrhh/backend/nomina/procesar-nomina', formData)
          .then(response => {
            console.log(response.data);
            this.chkNomina = '';
            this.chkConceptos = [];

            this.$swal({
              type: 'success',
              title: 'Nómina generada exitosamente',
              showConfirmButton: true,
            });
          })
          .catch(error => {
            console.log(error);
            this.$swal({
              type: 'warning',
              title: 'Ha ocurrido un error. Por favor intente nuevamente.',
              showConfirmButton: true,
            });
          })
      },
      obtenerConceptos() {
        axios.get('/rrhh/backend/perfil/obtener-conceptos')
          .then(response => {
            console.log(response.data);
            this.conceptos = response.data;
          })
      },
      obtenerNominas() {
        axios.get('/rrhh/backend/nomina/obtener-nominas')
          .then(response => {
            console.log(response.data);
            this.nominas = response.data;
          })
          .catch(error => {
            console.log(error)
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