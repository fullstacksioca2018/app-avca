<template>
  <div class="aspirantes__table">
    <div class="card">
      <div class="card-header bg-info-gradient">
        <h4 class="text-center aspirantes__title">Aspirantes en estatus: {{ estatusAnterior }}</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Nombre y Apellido</th>
              <th v-if="estatusAnterior === 'registrados'">Curriculum</th>
              <th v-if="estatusAnterior === 'verificados'">Requisitos</th>
              <th v-if="estatusAnterior === 'convocados'">Entrevista</th>
              <th v-if="estatusAnterior === 'seleccionados'">Teléfono de contacto</th>
              <th v-if="estatusAnterior === 'seleccionados'">Seleccionado</th>
              <th v-if="estatusAnterior === 'registrados'">{{ verEstatusSiguiente }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="aspirante in aspirantes" :key="aspirante.id">
              <td>{{ aspirante.created_at }}</td>
              <td>{{ aspirante.nombre }} {{ aspirante.apellido }}</td>
              <td v-if="estatusAnterior === 'registrados'">
                <a :href="aspirante.curriculum" class="btn btn-outline-info">
                  <i class="fa fa-file-pdf-o"></i> Ver curriculum
                </a>
              </td>
              <td v-if="estatusAnterior === 'verificados'">
                <button class="btn btn-outline-info" data-toggle="modal" data-target="#aspiranteVerificadoModal" @click.prevent="obtenerAspirante(aspirante)">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i> Enviar requisitos
                </button>
              </td>
              <td v-if="estatusAnterior === 'convocados'">
                <button class="btn btn-outline-info" data-toggle="modal" data-target="#aspiranteConvocadoModal" @click.prevent="obtenerAspirante(aspirante)">
                  <i class="fa fa-sticky-note" aria-hidden="true"></i>
                </button>
              </td>
              <td v-if="estatusAnterior === 'entrevistados'">
                <!--Aspirante entrevista modal-->
                <aspirante-entrevistado-modal :aspirante="aspirante" />
              </td>
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
              <td v-if="estatusAnterior === 'registrados'">
                <a href="#" class="btn btn-sm btn-outline-success" @click.prevent="cambiarEstatus(aspirante.aspirante_id)">
                  <i class="fa fa-check"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!--Aspirante verificado modal-->
    <aspirante-verificado-modal></aspirante-verificado-modal>

    <!--Aspirante convocado modal-->
    <aspirante-convocado-modal></aspirante-convocado-modal>

    <!--Aspirante entrevista modal-->
    <!--<aspirante-entrevistado-modal></aspirante-entrevistado-modal>-->
  </div>
</template>

<script>
  import {EventBus} from "../event-bus";
  import AspiranteVerificadoModal from "./AspiranteVerificadoModal";
  import AspiranteConvocadoModal from "./AspiranteConvocadoModal";
  import AspiranteEntrevistadoModal from "./AspiranteEntrevistadoModal";

  export default {
    name: "AspiranteTable",
    components: {AspiranteEntrevistadoModal, AspiranteConvocadoModal, AspiranteVerificadoModal},
    data() {
      return {
        aspirantes: [],
        estatus: 'registrados',
        estatusAnterior: 'registrados',
      }
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
    mounted() {
      EventBus.$on('aspirantes', (aspirantes) => {
        this.aspirantes = aspirantes;
      });
      EventBus.$on('estatus', (estatus) => {
        if (estatus !== '') {
          if (estatus === 'registrados') {
            this.estatus = 'verificados';
            this.estatusAnterior = 'registrados';
          }
          if (estatus === 'verificados') {
            this.estatus = 'convocados';
            this.estatusAnterior = 'verificados';
          }
          else if (estatus === 'convocados') {
            this.estatus = 'entrevistados';
            this.estatusAnterior = 'convocados';
          }
          else if (estatus === 'entrevistados') {
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
    methods: {
      cambiarEstatus(aspirante_id) {
        axios.get('/rrhh/backend/cambiar-estatus/', {
          params: {
            estatus: this.estatus,
            aspirante_id: aspirante_id
          }
        })
          .then(response => {
            //console.log(response.data);
            this.aspirantes = response.data;
            if (this.estatusAnterior === 'registrados') {
              this.$swal({
                //position: 'top-end',
                type: 'success',
                title: 'Aspirante verificado exitosamente.',
                showConfirmButton: false,
                timer: 2000
              });
            }
            if (this.estatus === 'por contratar') {
              this.$swal({
                //position: 'top-end',
                type: 'success',
                title: 'Aspirante por contratar.',
                showConfirmButton: false,
                timer: 2000
              });
            }
          })
          .catch(error => {
            console.log(error)
          })
      },
      obtenerAspirante(aspirante) {
        EventBus.$emit('email-verificado', aspirante);
        EventBus.$emit('aspirante-seleccionado', aspirante);
      }
    },
  }
</script>

<style scoped>

</style>