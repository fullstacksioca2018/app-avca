<template>
  <div>
    <form action="#">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="fecha">Período</label>
            <select name="fecha" id="fecha" class="form-control" required v-model="fecha" @change="obtenerVouchers">
              <option value="" selected="selected">Seleccione</option>
              <option value="01">Enero 2018</option>
              <option value="02">Febrero 2018</option>
              <option value="03">Marzo 2018</option>
              <option value="04">Abril 2018</option>
              <option value="05">Mayo 2018</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="tipo_nomina">Tipo de nómina</label>
            <select name="tipo_nomina" id="tipo_nomina" class="form-control" required v-model="tipoNomina" @change="obtenerVouchers">
              <option value="" selected="selected">Seleccione</option>
              <option :value="nomina.nomina_id" :key="nomina.id" v-for="nomina in nominas">{{ nomina.nombre | uppercase }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="filtro">Filtrar por</label>
            <select name="filtro" id="filtro" class="form-control"></select>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import moment from 'moment';
  export default {
    name: "ConsultarNomina",
    data() {
      return {
        vouchers: [],
        fecha: '',
        tipoNomina: '',
        nominas: []
      }
    },
    mounted() {
      this.obtenerVouchers();
      this.obtenerNominas();
    },
    methods: {
      obtenerVouchers() {
        axios.get('/rrhh/backend/nomina/obtener-vouchers', {
          params: {
            fecha: this.fecha,
            nomina: this.tipoNomina
          }
        })
          .then(response => {
            console.log(response.data);
            this.vouchers = response.data;
          })
      },
      obtenerNominas() {
        axios.get('/rrhh/backend/nomina/obtener-nominas')
          .then(response => {
            this.nominas = response.data;
          })
      }
    },
    filters: {
      moment: function(date) {
        moment.locale('es');
        return moment(date).format('MMMM YYYY');
      },
      uppercase:function(str) {
        str = str.toString();
        return str.charAt(0).toLocaleUpperCase() + str.slice(1);
      }
    }
  }
</script>

<style scoped>

</style>