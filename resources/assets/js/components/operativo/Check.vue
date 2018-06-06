<template>
  <div> 
    
  <b-tabs pills card>
    <b-tab title="Lista por Chequear" active>
       <porCheck></porCheck>
    </b-tab>
    <b-tab title="Lista de Chequeados" >
     <Chequeados> </Chequeados>
    </b-tab>
     <b-tab title="Todos">
      <CheckTodos> </CheckTodos>
    </b-tab>
  </b-tabs>

  </div>
</template>
<script>
  import porCheck from './porCheck';
  export default {
    components:{
      porCheck,
    }
  }
</script>