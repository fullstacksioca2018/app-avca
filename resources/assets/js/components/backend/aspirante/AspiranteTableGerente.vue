<template>
    <div>
        <div class="card">
      <div class="card-header bg-info-gradient">Lisado de aspirantes</div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Nombre y Apellido</th>              
              <th v-if="estatusAnterior === 'seleccionados'">Teléfono de contacto</th>
              <th v-if="estatusAnterior === 'seleccionados'">Seleccionado</th>              
            </tr>
          </thead>
          <tbody>
            <tr v-for="aspirante in aspirants" :key="aspirante.id">
              <td>{{ aspirante.created_at }}</td>
              <td>{{ aspirante.nombre }} {{ aspirante.apellido }}</td>              

              <!--Aspirante entrevista modal-->
              <td v-if="estatusAnterior === 'entrevistados'">
                <aspirante-entrevistado-modal :aspirante="aspirante" vacante="vacante" />
              </td>

              <!-- Aspirante seleccionado -->
              <td v-if="estatusAnterior === 'seleccionados'">
                <span>
                  <i class="fa fa-phone-square text-success"></i>
                  <b>{{ aspirante.telefono_movil }}</b>
                </span>
              </td>
              <td v-if="estatusAnterior === 'seleccionados'">
                <a href="#" class="text-info" @click.prevent="cambiarEstatus(aspirante.aspirante_id)">
                  <i class="fa fa-check-square-o fa-2x"></i>
                </a>
              </td>

            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>
</template>

<script>
import {EventBus} from "../event-bus";
import AspiranteEntrevistadoModal from "./AspiranteEntrevistadoModal";

export default {
    name: 'AspiranteTableGerente',
    props: ['aspirantes', 'vacante'],
    components: { AspiranteEntrevistadoModal },
    data() {
      return {
        aspirants: [],
        estatus: 'entrevistados',
        estatusAnterior: 'entrevistados',
      }
    },
    mounted() {
        this.aspirantesPorEstatus('entrevistados');
      EventBus.$on('aspirantes', (aspirantes) => {
        this.aspirants = aspirantes;
        console.log('Desde el mounted ', this.aspirants);
      });
      EventBus.$on('estatus', (estatus) => {
        if (estatus !== '') {          
          if (estatus === 'entrevistados') {
            this.estatus = 'seleccionados';
            this.estatusAnterior = 'entrevistados';
          }
          else if (estatus === 'seleccionados') {
            this.estatus = 'por contratar';
            this.estatusAnterior = 'seleccionados';
          }else if (estatus === 'por contratar') {
            this.estatusAnterior = 'por contratar';
          }
        } else {
          this.estatusAnterior = 'registrados';
        }
        console.log(this.estatus);
      })
    },
    computed: {
      verEstatusSiguiente() {
        if (this.estatusAnterior === 'registrados')
          return 'Verificar';
        else if (this.estatusAnterior === 'verificados')
          return 'Convocar';
        else if (this.estatusAnterior === 'convocados')
          return 'Entrevistar';
        else if (this.estatusAnterior === 'entrevistados')
          return 'Seleccionar';
        else {
          return 'Contactar';
        }
      }
    },
    methods: {
        cambiarEstatus(aspirante_id) {
            console.log('cambiarEstatus', this.estatus);
            console.log('Aspirante ', aspirante_id);
            console.log('Vacante ', this.vacante);
            let loader = this.$loading.show();
            axios.get('/rrhh/backend/seleccion/cambiar-estatus/', {
                params: {
                    estatus: this.estatus,
                    aspirante: aspirante_id,
                    vacante: this.vacante
                }
            })
                .then(response => {
                    console.log(response.data);
                    this.aspirants = response.data;
                    loader.hide();

                    if (this.estatus === 'por contratar') {
                        this.$swal({
                            //position: 'top-end',
                            type: 'success',
                            title: 'Aspirante por contratar.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        this.aspirantesPorEstatus('seleccionados');
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        },
        aspirantesPorEstatus(estatus) {        
            axios.get('/rrhh/backend/seleccion/aspirantes-estatus/', {
                params: {
                    vacante: this.vacante,
                    estatus: estatus
                }
            })
                .then((response) => {
                    console.log(response.data)
                    this.aspirants = response.data[0];
                    this.status = response.data[1];
                })
        },
        obtenerAspirante(aspirante) {
            EventBus.$emit('email-verificado', aspirante, this.vacante);
            EventBus.$emit('aspirante-seleccionado', aspirante, this.vacante);
        }          
    },
};
</script>

<style scoped>
</style>