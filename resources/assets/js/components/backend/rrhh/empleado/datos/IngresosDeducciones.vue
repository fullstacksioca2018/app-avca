<template>
  <div>
    <form action="#" @submit.prevent="procesarIngresosDeducciones" id="frmIngresosDeducciones" method="post">
      <div class="row form-group">
        <!--<div class="col-md-6">
          <h4> Asignaciones</h4>
          <div class="custom-control custom-checkbox ">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="sueldobasico">
            <label class="custom-control-label" for="sueldobasico">101  Sueldo Básico</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="primaantiguedad">
            <label class="custom-control-label" for="primaantiguedad">103 Prima por antigüedad</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="bonoasistencia">
            <label class="custom-control-label" for="bonoasistencia">201  Bono por asistencia</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="primahijo">
            <label class="custom-control-label" for="primahijo">105 Prima por Hijos</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="horaextraDiurna">
            <label class="custom-control-label" for="horaextraDiurna">107 Horas Extras Diurnas</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="horanocturna">
            <label class="custom-control-label" for="horanocturna">109  Horas Nocturnas</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="horaextraNocturna">
            <label class="custom-control-label" for="horaextraNocturna">111 Horas Extras Nocturnas</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="hdvp">
            <label class="custom-control-label" for="hdvp">113 Pago por Horas de Vuelo de Piloto</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="hdvc">
            <label class="custom-control-label" for="hdvc">115 Pago por Horas de Vuelo de Copiloto-Primer Oficial</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="hdvs">
            <label class="custom-control-label" for="hdvs">117 Pago por Horas de Vuelo de Sobrecargo</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="bdp">
            <label class="custom-control-label" for="bdp">203 Bono de productividad</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="diaferiado">
            <label class="custom-control-label" for="diaferiado">119  Días Feriados y de descanso</label>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="asignaciones[]" id="bonoriesgo">
            <label class="custom-control-label" for="bonoriesgo">205  Bono de Riesgo</label>
          </div>

        </div>-->

        <div class="col-md-6">
          <h4>Asignaciones</h4>
          <div
              class="custom-control custom-checkbox"
              v-for="concepto in conceptos"
              :key="concepto.id"
              v-if="concepto.tipo_concepto.charAt(0) !== '5'"
          >
            <input type="checkbox" name="asignaciones[]" :id="slugify(concepto.descripcion)" class="custom-control-input" :value="concepto.concepto_id">
            <label class="custom-control-label" :for="slugify(concepto.descripcion)">{{ concepto.tipo_concepto }} {{ concepto.descripcion }}</label>
          </div>
        </div>

        <div class="form-group">
          <h4>Deducciones</h4>
          <div
              class="custom-control custom-checkbox"
              v-for="concepto in conceptos"
              :key="concepto.id"
              v-if="concepto.tipo_concepto.charAt(0) === '5'"
          >
            <input type="checkbox" name="deducciones[]" :id="slugify(concepto.descripcion)" class="custom-control-input" :value="concepto.concepto_id">
            <label class="custom-control-label" :for="slugify(concepto.descripcion)">{{ concepto.tipo_concepto }} {{ concepto.descripcion }}</label>
          </div>
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