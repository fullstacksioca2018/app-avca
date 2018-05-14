<template>
  <div class="card">
    <div class="card-image" v-if="$slots.image">
      <slot name="image"></slot>
    </div>
    <div class="card-header" v-if="$slots.header">
      <slot name="header"></slot>
    </div>
    <div class="card-body" :class="colorCard">
      <slot></slot>
    </div>
    <div class="card-footer" v-if="$slots.footer">
      <hr>
      <slot name="footer"></slot>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'card',
    props:['colorB','colorI'],
    computed: {
      colorCard: function() {
        return this.colorB+" "+this.colorI;
      }
    }
  }
</script>
<style>
.card-body:hover{
  background: #fff;
  cursor: pointer;
}
.azure{
  background: #000;
}
.iconoF{
  color: #fff;
}

.card-footer{
  /* background: #28a745; */
  background: #75ec91;
  /* background: #e9ecef; */
}
.CardEjecutados{
  /* background: #e9ecef; */
  background: #e9ecef;
}
.CardAbiertos{
  /* background: #d0eaf7; */
  background: #e9ecef;
}
.CardDemorados{
  /* background: #f9e1c4; */
  background: #e9ecef;
}
.CardCancelados{
  /* background: #fff9e8; */
  background: #e9ecef;
}
.CardEjecutadosL{ 
  color: #28a745;
}
.CardAbiertosL{ 
  color: #9e5506;
}
.CardDemoradosL{ 
  color: #1b98d3;
}
.CardCanceladosL{
  color: #FF4A55;
}
h4.card-title{
  font-weight: 600;
}
</style>
