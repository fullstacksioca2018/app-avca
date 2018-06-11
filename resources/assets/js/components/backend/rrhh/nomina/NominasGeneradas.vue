<template>
  <div>

    <div class="row">
      <div class="col-md-2">
        <div class="form-group">                
          <label>Seleccione el mes</label>
          <b-form-select v-model="mes" :options="options" class="mb-3"/>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">          
          <label for="nombre">Seleccione Nómina</label>
          <select name="nombre" id="nombre" class="form-control" v-model="nomina" required @change="conceptosPorMes">
            <option value="" selected="selected">Seleccione</option>
            <option :value="nomina.nomina_id" v-for="nomina in nominas" :key="nomina.id">{{ nomina.nombre }}</option>
          </select>          
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <h4>Asignaciones</h4>            
          <ul class="list-unstyled">
            <li v-for="concepto in conceptos" :key="concepto.id" v-if="concepto.tipo_concepto.charAt(0) !== '5'">
              {{ concepto.descripcion }}
            </li>
          </ul>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <h4>Deducciones</h4>
          <ul class="list-unstyled">
            <li v-for="concepto in conceptos" :key="concepto.id" v-if="concepto.tipo_concepto.charAt(0) === '5'">
              {{ concepto.descripcion }}
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="alert alert-warning" v-show="conceptos.length == 0">
      <h4 class="text-center mb-0">
        <i class="fa fa-exclamation-circle"></i> Nómina no encontrada
      </h4>
    </div>
          
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
        nominas: [], 
        nomina: 1       ,
        mes: new Date().getMonth() + 1,
        options: [
            { value:1, text:"Enero" },
            { value:2, text:"Febrero" },
            { value:3, text:"Marzo" },
            { value:4, text:"Abril" },
            { value:5, text:"Mayo" },
            { value:6, text:"Junio" }
        ],
      }
    },
    mounted() {
      this.obtenerNominas();
      this.conceptosPorMes();   
    },
    watch: {
        'mes': function() {
            this.conceptosPorMes();
        }
    },
    methods: {
      conceptosPorMes() {        
        axios.get('/rrhh/backend/nomina/conceptos-mes', {
          params: {
            mes: this.mes,
            nomina: this.nomina
          }
      })
          .then(response => {
            console.log(response.data);
            this.conceptos = response.data;
          })
          .catch(error => {
            console.log(error);
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
    },
  }
</script>

<style scoped>

</style>