<template>
  <div class="card">
    <div class="card-header" v-if="$slots.header">
      <slot name="header"></slot>
    </div>
    <div class="card-body">
      <div v-if="tipoG=='Line'">
        <line-example :chart-data="datosG"></line-example>
      </div>
      <div v-else>
        <pie-example :chart-data="datosG"></pie-example>
      </div>
    </div>
    <div class="card-footer" v-if="$slots.footer">
      <slot name="footer"></slot>
    </div>
  </div>
</template>
<script>
  import Card from './Card.vue'
  import LineExample from '../LineExample.js'
  import PieExample from '../PieExample.js'

  export default {
    name: 'chart-card',
    components: {
      LineExample,
      PieExample,
      Card
    },
    props: ['datos','tipo'],
    computed: {
      tipoG: function() {
        return this.tipo;
    },
    datosG: function() {
        return this.datos;
    }
  }
}
</script>
