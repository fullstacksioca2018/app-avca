<template>
  <div> 
  
  <b-tabs pills card>
    <b-tab title="Vuelos Abiertos" active>
     <VuelosAbiertos> </VuelosAbiertos>
    </b-tab>
     <b-tab title="Vuelos Cancelados">
      <VuelosCancelados> </VuelosCancelados>
    </b-tab>
    <b-tab title="Vuelos Ejecutados">
      <VuelosEjecutados> </VuelosEjecutados>
    </b-tab>
    <b-tab title="Vuelos Retrasados">
      <VuelosRetrasados> </VuelosRetrasados>
    </b-tab>   
    <b-tab title="Vuelos Cerrados">
      <VuelosCerrados> </VuelosCerrados>
    </b-tab>
  </b-tabs>


  </div>

</template>
<script>
  export default {
    
  }
</script>
