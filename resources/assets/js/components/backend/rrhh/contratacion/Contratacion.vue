<template>
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">
        Contratación
      </div>
      <div class="card-body">        
        <buscador 
          formId="ContratacionForm" 
          @aspirante="obtenerAspirante" 
          @cargo="obtenerCargo"
          @sucursal="obtenerSucursal"
        >          
        </buscador>
        <hr>
        <form action="#" id="ContratacionForm" autocomplete="off" v-if="aspirante.length !== 0" enctype="multipart/form-data" @submit.prevent="procesarContratacion">
          <!--Datos personales-->
          <fieldset>
            <legend>Datos personales</legend>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cedula">Cédula</label>
                  <input type="text" name="cedula" id="cedula" class="form-control" v-model="aspirante.cedula" required >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="nombre">Nombres</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" :value="aspirante.nombre" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="apellido">Apellidos</label>
                  <input type="text" name="apellido" id="apellido" class="form-control" :value="aspirante.apellido" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Nacionalidad: {{ aspirante.nacionalidad === 'v' ? 'Venezolano' : 'Extranjero' }}</label>
                  <input type="hidden" name="nacionalidad" id="nacionalidad" class="form-control" :value="aspirante.nacionalidad">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <div class="input-group">
                  <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" :value="aspirante.fecha_nacimiento" >
                  <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-calendar"></i>
            </span>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="estado_civil">Estado civil</label>
                  <select name="estado_civil" id="estado_civil" class="form-control">
                    <option value="" selected="selected">Seleccione</option>
                    <option value="solter@">Solter@</option>
                    <option value="casad@">Casad@</option>
                    <option value="concubin@">Concubinato</option>
                    <option value="divorciad@">Divorciad@</option>
                    <option value="viud@">Viud@</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <input type="file" name="foto" id="foto" class="form-control-file">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Sexo: {{ aspirante.sexo === 'm' ? 'Masculino' : 'Femenino' }}</label>
                  <input type="hidden" name="sexo" id="sexo" class="form-control" :value="aspirante.sexo">
                </div>
              </div>
            </div>
          </fieldset>

          <hr>

          <!--Datos de habitacion-->
          <fieldset>
            <legend>Datos de habitación</legend>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="estado">Estado</label>
                  <select name="estado" id="estado" class="form-control" v-model="estado" @change="obtenerCiudades">
                    <option value="" selected="selected">Seleccione</option>
                    <option :value="estado.estado" v-for="estado in venezuela" :key="estado.id">{{ estado.estado }}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="ciudad">Ciudad</label>
                  <select name="ciudad" id="ciudad" class="form-control">
                    <option value="" selected="selected">Seleccione</option>
                    <option :value="ciudad" v-for="ciudad in ciudadesFiltradas" :key="ciudad.id">{{ ciudad }}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label for="direccion">Dirección local</label>
                <div class="input-group">
                  <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección local">
                  <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-location-arrow"></i>
                  </span>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <hr>

          <!--Datos de contacto-->
          <fieldset>
            <legend>Datos de contacto</legend>
            <div class="row mb-3">
              <div class="col-md-3">
                <label for="telefono_fijo">Teléfono fijo</label>
                <div class="input-group">
                  <input type="tel" class="form-control" name="telefono_fijo" id="telefono_fijo" placeholder="Teléfono fijo" :value="aspirante.telefono_fijo" >
                  <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-phone"></i>
            </span>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <label for="telefono_movil">Teléfono móvil</label>
                <div class="input-group">
                  <input type="tel" name="telefono_movil" id="telefono_movil" class="form-control" placeholder="Teléfono movil" :value="aspirante.telefono_movil" >
                  <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-mobile"></i>
            </span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <label for="email">Correo electrónico</label>
                <div class="input-group">
                  <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" :value="aspirante.email" >
                  <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-envelope"></i>
            </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <p class="font-weight-bold">¿Posee alguna discapacidad?</p>
                  <label>
                    <input type="radio" name="discapacidad" value="si" v-model="discapacidad"> Si
                  </label>
                  <label class="ml-3">
                    <input type="radio" name="discapacidad" value="no" v-model="discapacidad"> No
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden" name="tipo_discapacidad" :disabled="!toggleDiscapacidad">
                  <select name="tipo_discapacidad" id="tipo_discapacidad" class="form-control" :disabled="toggleDiscapacidad">
                    <option value="" selected="selected">Seleccione</option>
                    <option value="trastorno del habla y lenguaje">Trastorno del habla y lenguaje</option>
                    <option value="visual">Visual</option>
                    <option value="motriz">Motriz</option>
                    <option value="auditiva">Auditiva</option>
                  </select>
                </div>
              </div>
            </div>
          </fieldset>
          <hr>

          <!--Datos laborales-->
          <fieldset>
            <legend>Datos laborales</legend>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="sucursal">Sucursal</label>
                  <div class="form-control">{{ sucursal.nombre }}</div>
                  <input type="hidden" name="sucursal_id" id="sucursal_id" :value="sucursal.sucursal_id">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="departamento">Departamento</label>
                  <select name="departamento_id" id="departamento_id" class="form-control">
                    <option value="" selected="selected">Seleccione</option>
                    <option :value="departamento.departamento_id" v-for="departamento in departamentos" :key="departamento.id">{{ departamento.descripcion }}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="cargo">Cargo</label>
                  <div class="form-control">{{ cargo.titulo }}</div>
                  <input type="hidden" name="cargo_id" :value="cargo.cargo_id">
                  <!-- Guardando el area -->
                  <input type="hidden" name="area_id" :value="cargo.area_id">
                  <input type="hidden" name="nombre_cargo" :value="cargo.titulo">
                </div>
              </div>
              <div class="col-md-2">                
                <div class="form-group" v-if="cargo.area_id === 6 && cargo.titulo !== 'Analista de Talento Humano Área Tripulación'">
                  <label for="licencia">Licencia</label>
                  <input type="text" name="licencia" id="licencia" class="form-control" placeholder="Licencia del tripulante">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="nivel_academico">Nivel Académico</label>
                  <select name="nivel_academico" id="nivel_academico" class="form-control" v-model="nivel_academico" @change="obtenerProfesiones">
                    <option value="" selected="selected">Seleccione</option>
                    <option value="bachiller">Bachiller</option>
                    <option value="tsu">TSU</option>
                    <option value="profesional">Profesional</option>
                    <option value="especialista 1">Especialista 1</option>
                    <option value="especialista 2">Especialista 2</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="profesion">Profesión</label>
                  <select name="profesion" id="profesion" class="form-control">
                    <option value="" selected="selected">Seleccione</option>
                    <option :value="profesion.profesion_id" v-for="profesion in profesiones" :key="profesion.id">{{ profesion.titulo }}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="condicion_laboral">Condición laboral</label>
                  <select name="condicion_laboral" id="condicion_laboral" class="form-control">
                    <option value="" selected="selected">Seleccione</option>
                    <option value="fijo">Fijo</option>
                    <option value="contratado">Contratado</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="suplente">Suplente</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="tipo_horario">Tipo de horario</label>
                  <select name="tipo_horario" id="tipo_horario" class="form-control">
                    <option value="" selected="selected">Seleccione</option>
                    <option value="fijo">Fijo</option>
                    <option value="rotativo">Rotativo</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="fecha_ingreso">Fecha de ingreso</label>
                <div class="input-group">
                  <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control">
                  <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-calendar"></i>
            </span>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <hr>

          <!--Datos de nomina-->
          <fieldset>
            <legend>Datos de nómina</legend>
            <div class="row">
              <div class="col-md-2">
                <label>
                  <strong>Nivel:</strong>
                </label>
                <template v-if="tabulador !== ''">{{ tabulador[0].cod_nivel }}</template>
              </div>
              <div class="col-md-2">
                <label><strong>Sueldo base:</strong>
                </label>
                <template v-if="tabulador !== ''">{{ tabulador[0].sueldo_base }}</template>
              </div>
              <div class="col-md-8"></div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="banco">Banco</label>
                  <select name="banco" id="banco" class="form-control" @change="obtenerCodigoBancario" v-model="banco" required>
                    <option value="" selected="selected">Seleccione</option>
                    <option :value="banco.banco" v-for="banco in bancos" :key="banco.id">{{ banco.banco }}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label for="cuenta_bancaria">Número de cuenta bancaria</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <input type="text" name="codigo_cuenta" id="codigo_cuenta" :value="codigo_cuenta" size="4" style="border: none; background: transparent;">
                    </span>
                  </div>
                  <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" class="form-control" placeholder="Número de cuenta bancaria" maxlength="20" required>
                </div>
              </div>
            </div>
          </fieldset>
          <hr>

          <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i> Guardar y generar contrato
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import Buscador from "../Buscador";  

  export default {
    name: "Contratacion",
    components: {Buscador},
    data() {
      return {
        aspirante: '',
        datosPersonales: '',
        // Datos de habitacion
        venezuela: [],
        estado: '',
        ciudadesFiltradas: [],
        // Datos de contacto
        discapacidad: '',
        tipoDiscapacidad: [
          'trastorno del habla y lenguaje',
          'visual',
          'motriz',
          'auditiva'
        ],
        // Datos laborales
        sucursal: '',
        departamentos: [],        
        profesiones: [],
        nivel_academico: '',
        cargo: '',
        tabulador: '',
        // Datos de nomina
        tabulador: '',
        bancos: [],
        banco: '',
        codigo_cuenta: '',
      }
    },
    mounted() {
      this.obtenerEstados();
      // Laborales      
      this.obtenerDepartamentos();      
      // Nomina
      this.obtenerBancos();
    },
    methods: {
      obtenerAspirante(aspirante) {
        this.aspirante = aspirante;
      },
      obtenerCargo(cargo) {
        this.cargo = cargo;        
      },
      obtenerSucursal(sucursal) {
        this.sucursal = sucursal;        
      },
      //  Metodo para procesar el formulario de contratacion
      procesarContratacion() {
        let contratacionForm = document.getElementById('ContratacionForm');
        let formData = new FormData(contratacionForm);
        let loader = this.$loading.show();
        axios.post('/rrhh/backend/contratacion/contratacion', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
          .then(response => {
            console.log(response.data);
            this.$swal({
              //position: 'top-end',
              type: 'success',
              title: 'El empleado ha sido ingresado exitosamente.',
              showConfirmButton: true,
              //timer: 2000
            });
            document.getElementById('ContratacionForm').reset();
            loader.hide();
          })
      },
      procesarEmpleado() {
        this.$swal({
          //position: 'top-end',
          type: 'warning',
          title: 'Se está trabajando en la funcionalidad de guardado...',
          showConfirmButton: true,
          //timer: 2000
        });
      },
      // Metodos de habitacion
      obtenerEstados() {
        axios.get('/rrhh/backend/contratacion/obtener-estados')
          .then((response) => {
            this.venezuela = response.data;
          });
      },
      obtenerCiudades() {
        this.ciudades = this.venezuela.filter(venezuela => venezuela.estado === this.estado);
        if (typeof (this.ciudades[0].ciudades) !== 'undefined') {
          for (let i = 0; i < this.ciudades[0].ciudades.length; i++) {
            this.ciudadesFiltradas = this.ciudades[0].ciudades;
          }
        } else {
          this.ciudadesFiltradas = '';
        }
      },
      // Laborales      
      obtenerDepartamentos() {
        axios.get('/rrhh/backend/contratacion/obtener-departamentos')
          .then((response) => {
            this.departamentos = response.data;
          });
      },      
      obtenerProfesiones() {
        axios.get('/rrhh/backend/contratacion/obtener-profesiones', {
          params: {
            nivel_academico: this.nivel_academico
          }
        })
          .then((response) => {
            this.profesiones = response.data;
          });
      },
      obtenerTabulador(tabulador) {
        console.log(tabulador);
      },
      obtenerTabuladorSalarial() {        
        /*axios.get('/rrhh/backend/contratacion/obtener-tabulador', {
          params: {
            tabulador_salarial_id: this.cargo.tabulador_salarial
          }
        })
          .then((response) => {
            this.tabulador = response.data;
          });*/
      },
      // Nomina
      obtenerBancos() {
        axios.get('/rrhh/backend/contratacion/obtener-bancos')
          .then((response) => {
            this.bancos = response.data;
          });
      },
      obtenerCodigoBancario() {
        var that = this;
        const banco = this.banco;
        this.bancos.forEach(function (element) {
          if (banco === element.banco) {
            that.codigo_cuenta = element.codigo;
          }
        });
      },
    },
    computed: {
      toggleDiscapacidad: function() {
        if (this.discapacidad === 'si') return false;
        else return true;
      }
    },
  }
</script>

<style scoped>

</style>