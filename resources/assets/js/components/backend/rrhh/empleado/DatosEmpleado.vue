<template>
  <div>
    <transition name="fade" tag="div">
      <div class="media" v-if="empleado.length !== 0">
        <!-- <img class="mr-3 empleado-img img-thumbnail" :src="'http://avca.oo/storage/empleados/' + empleado.foto" :alt="fullName"> -->
        <img class="mr-3 empleado-img img-thumbnail" :src="ruta +'/storage/empleados/'+ empleado.cedula + '/foto/' + empleado.foto" :alt="fullName">
        <div class="media-body">  
          <div class="row empleado">
            <div class="col-md-6 empleado-item">
              <h5>Nombre: </h5>
              <span class="ml-2">{{ fullName }}</span>
            </div>
            <div class="col-md-3 empleado-item">
              <h5>Cédula: </h5>
              <span class="ml-2">{{ empleado.cedula }}</span>
            </div>
            <div class="col-md-3 empleado-item">
              <h5>Fecha ingreso: </h5>
              <span class="ml-2">{{ empleado.fecha_ingreso.split("-").reverse().join("/") }}</span>
            </div>
          </div>
          <div class="row empleado my-3">
            <div class="col-md-6 empleado-item">
              <h5>Sucursal: </h5>
              <span class="ml-2">{{ sucursal.nombre }}</span>
            </div>
            <div class="col-md-6 empleado-item">
              <h5>Departamento: </h5>
              <span class="ml-2">{{ departamento.descripcion }}</span>
            </div>
          </div>
          <div class="row empleado">
            <div class="col-md-6 empleado-item">
              <h5>Cargo: </h5>
              <span class="ml-2">{{ cargo.titulo }}</span>
            </div>
            <div class="col-md-6 empleado-item">
              <h5>Condición laboral: </h5>
              <span class="ml-2">{{ empleado.condicion_laboral }}</span>
            </div>
          </div>        
        </div>
      </div>
    </transition>    
  </div>
  
</template>

<script>
import { EventBus } from "./event-bus";

export default {
  name: "DatosEmpleado",
  props: ["ruta", "empleado"],
  data() {
    return {
      //empleado: "",
      sucursal: "",
      departamento: "",
      cargo: "",      
    };
  },
  mounted() {
    /*EventBus.$on("empleado", empleado => {
      if (empleado.length !== 0) {
        this.empleado = empleado;          
      }
    });*/
    if (this.empleado.length !== 0) {
      this.obtenerSucursal();
      this.obtenerDepartamento();
      this.obtenerCargo();
    }
    //console.log('Datos ', this.ruta);
    EventBus.$emit('projectPath', this.ruta);
  },
  computed: {
    fullName: function() {
      return this.empleado.nombre + " " + this.empleado.apellido;
    },
  },
  methods: {
    obtenerSucursal() {
      axios
        .get("/rrhh/backend/perfil/obtener-sucursal", {
          params: {
            sucursal: this.empleado.sucursal
          }
        })
        .then(response => {
          this.sucursal = response.data;
        });
    },
    obtenerDepartamento() {
      if (this.empleado.sucursal === "") return;
      axios
        .get("/rrhh/backend/perfil/obtener-departamento", {
          params: {
            departamento: this.empleado.departamento
          }
        })
        .then(response => {
          this.departamento = response.data;
        });
    },
    obtenerCargo() {
      if (this.empleado.cargo === "") return;
      axios
        .get("/rrhh/backend/perfil/obtener-cargo", {
          params: {
            cargo: this.empleado.cargo
          }
        })
        .then(response => {
          this.cargo = response.data;
        });
    },    
  }
};
</script>

<style lang="scss" scoped>
.empleado-img {
  max-width: 15%;
}
.empleado-item {
  display: flex;
  align-items: baseline;
  font-size: 16px;
  h5 {
    color: #17a2b8;
    font-size: 16px;
    font-weight: 600;
    margin: 0;
    padding: 0;
  }
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>