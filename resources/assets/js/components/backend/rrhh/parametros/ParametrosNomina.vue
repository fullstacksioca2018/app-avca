<template>
    <div>
        <div class="card">
            <div class="card-header bg-info-gradient">Parámetros de nómina</div>
            <div class="card-body">
                <!-- Menu -->
                <ul class="nav justify-content-center nav-pills">
                    <li class="nav-item" @click.prevent="menu = 0">
                        <a :class="menu == 0 ? 'nav-link active': 'nav-link'" href="#">
                            <i class="fa fa-refresh"></i> Tabulador salarial
                        </a>
                    </li>                    
                    <li class="nav-item" @click.prevent="menu = 1">
                        <a :class="menu == 1 ? 'nav-link active': 'nav-link'" href="#">
                            <i class="fa fa-cogs"></i> Conceptos
                        </a>
                    </li>
                    <li class="nav-item" @click.prevent="menu = 2">
                        <a :class="menu == 2 ? 'nav-link active': 'nav-link'" href="#">
                            <i class="fa fa-cogs"></i> Variables
                        </a>
                    </li>
                </ul>

                <!-- Listado de tabuladores -->
                <template v-if="menu == 0">
                    <tabulador-salarial></tabulador-salarial>
                </template>
                <!-- Listado de conceptos -->
                <template v-if="menu == 1">
                    <conceptos></conceptos>
                </template>
                <!-- Variables -->
                <template v-if="menu == 2">
                    <variables></variables>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import Conceptos from './Conceptos';
import Variables from './Variables';
import TabuladorSalarial from './TabuladorSalarial';

export default {
  name: "ParametrosNomina",
  components: {Conceptos, TabuladorSalarial, Variables},
  data() {
      return {
          menu: 0
      }
  },
};
</script>

<style scoped>
</style>