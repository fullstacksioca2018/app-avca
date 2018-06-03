<template>
  <div>
    <form action="#" method="post" id="frmDatosPersonales" @submit.prevent="actualizarEmpleado">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <div class="form-control disabled">{{ empleado.nombre }}</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <div class="form-control disabled">{{ empleado.apellido }}</div>
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
            <div class="form-control disabled">{{ empleado.estado_civil }}</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <div class="form-control disabled">{{ empleado.fecha_nacimiento }}</div>
          </div>
        </div>
        <div class="col-md-6">
          <p class="mb-2">Sexo</p>
          <div class="form-control disabled">{{ empleado.sexo === 'f' ? 'Femenino' : 'Masculino' }}</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="nivel_academico">Nivel académico</label>
            <div class="form-control disabled">{{ empleado.nivel_academico }}</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="profesion">Profesión</label>
            <div class="form-control disabled">{{ profession }}</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="estado">Estado</label>
            <div class="form-control disabled">{{ empleado.estado }}</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <div class="form-control disabled">{{ empleado.ciudad }}</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="direccion">Dirección</label>
            <div class="form-control disabled">{{ empleado.direccion }}</div>
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
            <div class="form-control disabled">{{ empleado.email }}</div>
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
        profession: '',
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
            this.profesiones.forEach(profesion => {              
              if (profesion.profesion_id == this.empleado.profesion) {
                this.profession = profesion.titulo                
              }
            })
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
  .disabled {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
    opacity: 0.65;
  }
</style>