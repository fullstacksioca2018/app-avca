<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <form autocomplete="off">
          <div class="input-group">
            <input type="text" name="cedula" id="cedula" class="form-control" placeholder="Ingrese la cédula a buscar..." v-model="busqueda" @keyup.prevent="obtenerAspirantesPorCedula">
            <div class="input-group-append">
              <button class="btn btn-outline-info" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <ul class="nav flex-column">
          <li
              class="nav-item"
              v-for="aspirante in aspirantes"
              :key="aspirante.id">
            <a href="#" class="nav-link" @click.prevent="obtenerAspiranteInfo(aspirante)">
              {{ aspirante.nombre }} {{ aspirante.apellido }}
            </a>
          </li>
        </ul>
        <!--<resultados-busqueda :aspirantes="aspirantes" @aspirante="obtenerAspirante"></resultados-busqueda>-->
      </div>
    </div>
  </div>
</template>

<script>  
  export default {
    name: "Buscador",    
    props: {
      formId: {
        type: String,
        default: ''
      },
    },
    data() {
      return {
        busqueda: '',
        aspirantes: [],
        aspirante: '',        
      }
    },
    methods: {
      obtenerAspirantesPorCedula() {
        if (this.busqueda !== '') {
          axios.get('/rrhh/backend/obtener-aspirantes/' + this.busqueda)
            .then(response => {
              //console.log(response.data);
              this.aspirantes = response.data;
            })
        } else {
          document.getElementById(this.formId).reset();
        }
      },
      obtenerAspiranteInfo(aspirante) {
        axios.get('/rrhh/backend/contratacion/obtener-aspirante-info/' + aspirante.aspirante_id)
        /*axios.get('/rrhh/backend/contratacion/contratacion', {
          params: {
            aspirante_id: aspirante.aspirante_id
          }
        })*/
          .then(response => {
            //console.log(response.data);
            this.aspirante = response.data;
            this.busqueda = aspirante.cedula;
            this.$emit('aspirante', response.data);
            this.aspirantes.splice(0);

            // Obtengo el cargo
            this.obtenerCargo(this.aspirante);
            // Obtengo la sucursal
            this.obtenerSucursal(this.aspirante);
          })
          .catch(error => {
            console.log(error)
          });
      },
      obtenerSucursal(aspirante) {
        axios.get('/rrhh/backend/contratacion/obtener-sucursal', {
          params: {
            vacante_id: aspirante.vacante_id
          }
        })
          .then((response) => {
            this.$emit('sucursal', response.data);
          });
      },
      obtenerCargo(aspirante) {        
        axios.get('/rrhh/backend/contratacion/obtener-cargo', {
          params: {
            cargo_id: aspirante.cargo_id
          }
        })
          .then((response) => {
            this.$emit('cargo', response.data);
          });
      },
      /*obtenerAspirante(aspirante) {
        //this.aspirante = aspirante;
        this.$emit('aspirante', aspirante);
      }*/
    },
  }
</script>

<style scoped>

</style>