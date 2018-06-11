<template>
  <div>
    <form action="#" method="post" id="frmDatosPersonales" @submit.prevent="actualizarEmpleado">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" :value="empleado.nombre">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" :value="empleado.apellido">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="foto">Foto de perfil</label>
            <input type="file" name="foto" id="foto" class="form-control">
          </div>
        </div>
        </div>

      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="estado_civil">Estado civil</label>
            <select name="estado_civil" id="estado_civil" class="form-control">
              <option :value="ec" v-for="ec in estadoCivil" :key="ec.id" :selected="ec === empleado.estado_civil">{{ ec }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" :value="empleado.fecha_nacimiento">
          </div>
        </div>
        <div class="col-md-6">
          <p class="mb-2">Sexo</p>
          <label class="mr-3">
            <input type="radio" name="sexo" value="f" :checked="empleado.sexo === 'f'"> F
          </label>
          <label>
            <input type="radio" name="sexo" value="m" :checked="empleado.sexo === 'm'"> M
          </label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="nivel_academico">Nivel académico</label>
            <select name="nivel_academico" id="nivel_academico" class="form-control" @change="obtenerProfesiones">
              <option
                  :value="na"
                  v-for="na in nivelAcademico"
                  :selected="na === empleado.nivel_academico"
                  :key="na.id">{{ na }}
              </option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="profesion">Profesión</label>
            <select name="profesion" id="profesion" class="form-control">
              <option
                  :value="profesion.profesion_id"
                  v-for="profesion in profesiones"
                  :selected="profesion.profesion_id == empleado.profesion"
                  :key="profesion.id"
              >{{ profesion.titulo }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" v-model="estado" @change="obtenerCiudades">
              <option
                  :value="estado.estado"
                  v-for="estado in estados"
                  :key="estado.id"
                  :selected="estado.estado == empleado.estado">{{ estado.estado }}
              </option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <select name="ciudad" id="ciudad" class="form-control" v-if="ciudadesFiltradas.length !== 0">
              <option
                  :value="ciudad"
                  v-for="ciudad in ciudadesFiltradas"
                  :selected="ciudad == empleado.ciudad"
                  :key="ciudad.id">{{ ciudad }}
              </option>
            </select>
            <template v-else>
              <div class="form-control">{{ empleado.ciudad }}</div>
              <input type="hidden" name="ciudad" :value="empleado.ciudad">
            </template>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" :value="empleado.direccion">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <p>¿Posee alguna discapacidad?{{ empleado.tipo_discapacidad }}</p>
            <label class="mr-3">
              <input type="radio" name="discapacidad" value="si" v-model="discapacidad"> Si
            </label>
            <label>
              <input type="radio" name="discapacidad" value="no" v-model="discapacidad"> No
            </label>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="tipo_discapacidad">Tipo de discapacidad</label>
            <select name="tipo_discapacidad" id="tipo_discapacidad" class="form-control" :disabled="toggleDiscapacidad">
              <option :value="td" v-for="td in tipoDiscapacidad" :key="td.id" :selected="td===empleado.tipo_discapacidad">{{ td }}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="telefono_fijo">Teléfono fijo</label>
            <input type="tel" name="telefono_fijo" id="telefono_fijo" :value="empleado.telefono_fijo" class="form-control">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="telefono_movil">Teléfono móvil</label>
            <input type="tel" name="telefono_movil" id="telefono_movil" :value="empleado.telefono_movil" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="tel" name="email" id="email" :value="empleado.email" class="form-control">
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <button type="submit" class="btn btn-info">Actualizar datos</button>
      </div>

      <input type="hidden" name="cedula" :value="empleado.cedula">
      <input type="hidden" name="empleado_id" :value="empleado.empleado_id">
    </form>
  </div>
</template>

<script>
  import VueSweetalert2 from 'vue-sweetalert2';
  Vue.use(VueSweetalert2);

  export default {
    name: "DatosPersonales",
    props: ['empleado', 'ruta'],
    data() {
      return {
        sucursales: '',
        estadoCivil: [
          'solter@',
          'casad@',
          'concubinato',
          'divorciad@',
          'viud@'
        ],
        nivelAcademico: [
          'bachiller',
          'tsu',
          'profesional',
          'especialista 1',
          'especialista 2'
        ],
        nivel_academico: '',
        profesiones: [],
        estados: [],
        estado: this.empleado.estado,
        ciudadesFiltradas: [],
        discapacidad: '',
        tipoDiscapacidad: [
          'trastorno del habla y lenguaje',
          'visual',
          'motriz',
          'auditiva'
        ],
      }
    },
    mounted() {
      this.obtenerProfesiones();
      this.obtenerEstados();      
    },
    methods: {
      actualizarEmpleado() {
        let frmDatosPersonales = document.getElementById('frmDatosPersonales');
        let formData = new FormData(frmDatosPersonales);

        axios.post('/rrhh/backend/perfil/actualizar-empleado', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
          .then(response => {
            console.log(response.data);
            this.$swal({
              //position: 'top-end',
              type: 'success',
              title: 'Los datos del empleado han sido actualizados.',
              showConfirmButton: true,
              //timer: 2000
            });
          })
          .catch(error => {
            this.$swal({
              //position: 'top-end',
              type: 'warning',
              title: 'Ha ocurrido un error. Intente nuevamente.',
              showConfirmButton: true,
              //timer: 2000
            });
          })
      },
      obtenerProfesiones() {
        axios.get('/rrhh/backend/contratacion/obtener-profesiones', {
          params: {
            nivel_academico: this.empleado.nivel_academico
          }
        })
          .then((response) => {
            this.profesiones = response.data;
          });
      },
      obtenerEstados() {        
        axios.get('/rrhh/backend/contratacion/obtener-estados')
          .then((response) => {
            this.estados = response.data;
            this.obtenerCiudades();
          });
      },
      obtenerCiudades() {        
        let ciudades = this.estados.filter(estado => estado.estado === this.estadoCapital);
        if (typeof (ciudades[0].ciudades) !== 'undefined') {
          this.ciudadesFiltradas = ciudades[0].ciudades;
        } else {
          this.ciudadesFiltradas = '';
        }
      },
    },
    computed: {
      toggleDiscapacidad: function() {
        if (this.discapacidad === 'si') return false;
        else return true;
      },
      estadoCapital: function () {        
        this.estado = this.estado.toString()
        return this.estado.charAt(0).toUpperCase() + this.estado.slice(1)
      }
    },
  }
</script>

<style scoped>
  .empleado-img {
    max-width: 15%;
  }
</style>