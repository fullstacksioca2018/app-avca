<template>
  <div class="asistencia-empleado">
    <div class="form-group">
      <label for="codigo">Por favor lea código de barra de su carnet o ingrese manualmente su cédula</label>
      <input type="text" name="codigo" id="codigo" class="form-control input-lg" autofocus="autofocus" v-model="codigo" @change.prevent="obtenerEmpleado">
    </div>

    <div class="img-pistola text-center" v-if="empleado === ''">
      <img src="/img/rrhh/pistola-codigo-barras.png" alt="Pistola de códigos">
    </div>

    <div class="empleado" v-else>
      <div class="pull-right">
        <!-- <p>Hoy es, <span class="fecha">{{ fechaActual }}</span></p> -->
      </div>
      <div class="clearfix"></div>
      <div class="alert alert-dark text-center">
        <h6 class="m-0 p-0">Sucursal <b>{{ empleado.nombre_sucursal }}</b> de AVCA</h6>
      </div>

      <!--Informacion del empleado-->
      <div class="media">
        <!--<img class="mr-3 img-fluid" src="{{ asset('img/rrhh/caricature.jpg') }}" alt="Generic placeholder image" style="width: 15%;">-->
        <img :src="empleado.foto === '' ? '/img/rrhh/businessman.png' : `/storage/empleados/${empleado.cedula}/foto/${empleado.foto}`"
             alt="foto del empleado"
             class="img-fluid img-thumbnail mr-3"
             style="width: 15%;"
        >
        <div class="media-body">
          <div class="row">
            <div class="col-6">
              <p>
                <span class="font-weight-bold">Nombre: </span>
                {{ empleado.nombre }} {{ empleado.apellido }}
              </p>
              <p>
                <span class="font-weight-bold">Departamento: </span>
                {{ empleado.nombre_departamento }}
              </p>
            </div>
            <div class="col-6">
              <p>
                <span class="font-weight-bold">Cédula: </span>
                <span class="text-uppercase">{{ empleado.nacionalidad }}</span>.-{{ empleado.cedula}}
              </p>
              <p>
                <span class="font-weight-bold">Cargo: </span>
                {{ empleado.nombre_cargo }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!--Hora-->
      <div class="hora text-center">        
        <h6 v-if="asistencia !== null">Hora de salida</h6>
        <h6 v-else>Hora de entrada</h6>        
        <h2>{{ horaActual }}</h2>
      </div>
    </div>
  </div>
</template>

<script>
  import moment from 'moment';

  export default {
    name: "Empleado",
    data() {
      return {
        asistencia: '',
        empleado: '',
        codigo: ''
      }
    },
    methods: {
      obtenerEmpleado() {
        let loader = this.$loading.show();
        axios.get('/rrhh/backend/asistencia/obtener-empleado/' + this.codigo)
          .then((response) => {
            console.log(response.data)
            this.empleado = response.data[0];
            this.asistencia = response.data[1];
            loader.hide();
            setTimeout(() => {
              window.location.reload(true);
            }, 10000)
          })
          .catch((error) => {
            console.error(error)
          })
      }
    },
    computed: {
      fechaActual: function () {
        moment.locale('es');
        return moment().format('LL');
      },
      horaActual: function () {
        moment.locale('es');
        return moment().format('HH:mm:ss');
      }
    }
  }
</script>

<style scoped>

</style>