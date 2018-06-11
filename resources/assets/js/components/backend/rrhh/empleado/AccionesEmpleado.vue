<template>
  <div>
    <div class="row">
      <div class="col-md-10 offset-md-1 text-center">
        <ul class="nav nav-pills nav-justified">
          <li @click.prevent="menu = 0" class="nav-item">
            <a :class="menu == 0 ? 'nav-link active': 'nav-link'" href="#">
              <i class="fa fa-cogs"></i> Datos personales
            </a>
          </li>
          <li @click.prevent="menu = 1" class="nav-item">
            <a :class="menu == 1 ? 'nav-link active': 'nav-link'" href="#">
              <i class="fa fa-refresh"></i> Ingresos-Deducciones
            </a>
          </li>
          <li @click.prevent="menu = 2" class="nav-item">
            <a :class="menu == 2 ? 'nav-link active': 'nav-link'" href="#">
              <i class="fa fa-cogs"></i> Carga familiar
            </a>
          </li>
          <li @click="menu = 3" class="nav-item">
            <a :class="menu == 3 ? 'nav-link active': 'nav-link'" href="#">
              <i class="fa fa-cogs"></i> Expediente laboral
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-12 py-5">
        <template v-if="menu == 0">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <DatosPersonales :empleado="empleado" :ruta="ruta"></DatosPersonales>
            </div>
          </div>
        </template>
        <template v-if="menu == 1">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <ingresos-deducciones :empleado="empleado"></ingresos-deducciones>
            </div>
          </div>
        </template>
        <template v-if="menu == 2">
          <carga-familiar :empleado="empleado"></carga-familiar>
        </template>
        <template v-if="menu == 3">               
          <expediente-laboral :empleado="empleado" :ruta="ruta"></expediente-laboral>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from "./event-bus";
import DatosPersonales from "./datos/DatosPersonales";
import CargaFamiliar from "./datos/CargaFamiliar";
import IngresosDeducciones from "./datos/IngresosDeducciones";
import ExpedienteLaboral from "./datos/ExpedienteLaboral";

export default {
  components: {ExpedienteLaboral, CargaFamiliar, DatosPersonales, IngresosDeducciones},
  props: ['ruta', 'empleado'],
  data() {
    return {
      menu: 0
    }
  },
};
</script>

<style scoped>

</style>