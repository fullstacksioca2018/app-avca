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
              <th>{{ verEstatusSiguiente }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="aspirante in aspirantes">
              <td>{{ aspirante.created_at }}</td>
              <td>{{ aspirante.nombre }} {{ aspirante.apellido }}</td>
              <td v-if="estatusAnterior === 'registrados'">
                <a :href="aspirante.curriculum" class="btn btn-outline-info">
                  <i class="fa fa-file-pdf-o"></i> Ver curriculum
                </a>
              </td>
              <td>
                <a href="#" class="btn btn-sm btn-outline-success" @click.prevent="cambiarEstatus(aspirante.aspirante_id)">
                  <i class="fa fa-check"></i>
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

  export default {
    name: "AspiranteTable",
    data() {
      return {
        aspirantes: [],
        estatus: 'registrados',
        estatusAnterior: 'registrados'
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
          } else if (estatus === 'seleccionados') {
            this.estatusAnterior = 'seleccionados';
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
            console.log(response.data);
            this.aspirantes = response.data;
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
  }
</script>

<style scoped>

</style>