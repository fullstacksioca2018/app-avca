<template>
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">Empleados</div>
      <div class="card-body">
        <hr>
        <div class="row mt-3">
          <div class="col-12">
            <!-- Datos del empleado -->            
            <datos-empleado :ruta="ruta" :empleado="empleado" />
          </div>
        </div>
        <div class="row py-5">
          <div class="col-12">
            <!-- Menu de acciones para el empleado -->
            <acciones-empleado :ruta="ruta" :empleado="empleado" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DatosEmpleado from "./DatosEmpleado.vue";
import AccionesEmpleado from "./AccionesEmpleado.vue";

export default {
  name: "FichaEmpleado",
  props: ["ruta", "empleado"],
  components: { DatosEmpleado, AccionesEmpleado },
};
</script>

<style scoped>

</style>