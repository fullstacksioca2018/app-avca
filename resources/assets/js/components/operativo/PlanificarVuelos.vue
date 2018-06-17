<template>
  <div> 
    
  <b-tabs pills card>
    <b-tab title="Nuevo Vuelo">
       <RegistrarVuelos></RegistrarVuelos>
    </b-tab>
    <b-tab title="Abiertos" active>
     <VuelosAbiertos> </VuelosAbiertos>
    </b-tab>
    <b-tab title="En Chequeo">
     <VuelosChequeo> </VuelosChequeo>
    </b-tab>
     <b-tab title="Cancelados">
      <VuelosCancelados> </VuelosCancelados>
    </b-tab>
    <b-tab title="Ejecutados">
      <VuelosEjecutados> </VuelosEjecutados>
    </b-tab>
    <b-tab title="Retrasados">
      <VuelosRetrasados> </VuelosRetrasados>
    </b-tab>   
    <b-tab title="Cerrados">
      <VuelosCerrados> </VuelosCerrados>
    </b-tab>
  </b-tabs>


  </div>

</template>
<script>
  import RegistrarVuelos from './RegistrarVuelos';
  export default {
    components:{
      RegistrarVuelos
    }
  }
</script>
