<template>
  <div class="content">
    <div v-show="GraficaP==null">
      <div class="card">
       
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <a @click="generar(1)">
              <stats-card colorB="CardEjecutados" colorI="CardEjecutadosL">
                <div slot="header" class="icon-warning">
                  <i class="fa fa-check-square-o fa-5x"></i>
                </div>
                <div slot="content">
                  <p class="card-category marginLe">Ejecutados</p>
                  <h4 class="card-title">{{ ejecutados }}</h4>
                </div>
              
              </stats-card>
            </a>
          </div>
        <div class="col-xl-3 col-md-6">
          <a @click="generar(2)">
            <stats-card colorB="CardAbiertos" colorI="CardAbiertosL">
              <div slot="header" class="icon-success">
                <i class="fa fa-line-chart fa-5x"></i>
              </div>
              <div slot="content">
                <p class="card-category marginLe">Abiertos</p>
                <h4 class="card-title">{{ abiertos }}</h4>
              </div>
            
            </stats-card>
          </a>
        </div>

        <div class="col-xl-3 col-md-6">
          <a @click="generar(3)">
            <stats-card colorB="CardDemorados" colorI="CardDemoradosL">
              <div slot="header" class="icon-danger">
                <i class="fa fa-clock-o fa-5x"></i>
              </div>
              <div slot="content">
                <p class="card-category marginLe">Demorados</p>
                <h4 class="card-title">{{ demorados }}</h4>
              </div>
             
            </stats-card>
          </a>
        </div>

        <div class="col-xl-3 col-md-6">
          <a @click="generar(4)">
            <stats-card colorB="CardCancelados" colorI="CardCanceladosL">
              <div slot="header" class="icon-info">
                <i class="fa fa-times fa-5x"></i>
              </div>
              <div slot="content">
                <p class="card-category marginLe">Cancelados</p>
                <h4 class="card-title">{{ cancelados }}</h4>
              </div>
             
            </stats-card>
          </a>
        </div>

      </div>
    </div>

    
      </div>
      </div>
     
     
  
</template>
<script type="text/javascript">
  import StatsCard from './Cards/StatsCard.vue'
 
  export default {
    components: {
      StatsCard,
    }, 
    data () {
      return {
        GraficaP:null,
        ejecutados:0,
        abiertos:0,
        demorados:0,
        cancelados:0,     
      }
    },    
    methods:{      
        vuelos(estado){
         /*  axios({
                method: 'get',
                url: '/reportes/api/vuelos/'+estado       
            }).then((response) =>{
                switch (estado) {
                  case "abierto":
                    this.abiertos=response.data
                    break;
                  case "cancelado":
                    this.cancelados=response.data
                    break;
                  case "demorado":
                    this.demorados=response.data
                    break;
                  case "ejecutado":
                    this.ejecutados=response.data
                    break;
                }
            }).catch((err)=>{
                Vue.toasted.show('Ha ocurrido un error', {
                    theme: "primary", 
                  position: "bottom-right",  
                  duration : 2000
                });
                console.log(err); 
            });*/
            switch (estado) {
                  case "abierto":
                    this.abiertos=0
                    break;
                  case "cancelado":
                    this.cancelados=0
                    break;
                  case "demorado":
                    this.demorados=0
                    break;
                  case "ejecutado":
                    this.ejecutados=0
                    break;
                }
        }        
      },
    created: function(){
      this.vuelos("ejecutado")
      this.vuelos("abierto")
      this.vuelos("demorado")
      this.vuelos("cancelado")    
    }
  }
</script>
<style type="text/css">
hr{
    box-sizing: content-box;
    margin-top: 0rem; 
    margin-bottom: 0rem; 
    border: 0;
    border-top: 0px;
    height: 0;
    overflow: none;
}
.stats{
  cursor: pointer;
}
  .fade2-enter-active {
    transition: all .8s cubic-bezier(.2, 0.3, 0.4, .4);
  }
  .fade2-leave-active {
    transition: all 0.1s cubic-bezier(.3, 0.2, 0.2, .3);
  }
  .fade2-enter, .fade2-leave-to {
    transform: translateX(10px);
    opacity: 0;
  }
  .fade-enter-active {
    transition: all 0.8s cubic-bezier(.2, 0.3, 0.4, .4);
  }
  .fade-leave-active {
    transition: all 0.1s;
  }
  .fade-enter, .fade-leave-to {
    transform: translateX(5px);
    opacity: 0;
  }
  .fade-button-enter-active {
    transition: all .2s ease;
  }
  .fade-button-leave-active {
    transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }
  .fade-button-enter, .fade-button-leave-to {
    transform: translateX(10px);
    opacity: 0;
  }
</style>