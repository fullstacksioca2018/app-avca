<template>
  <div class="content">
 <transition name="fade2" mode="out-in" >
  <div v-show="GraficaP==null">
    <div class="card">
      <div class="card-header text-center">
          <strong>Vuelos De la Quincena</strong>
      </div>
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
            <div slot="footer">
              <a class="badge badge-light" @click="generar(1)"><i class="fa fa-plus-square"></i> Ver más</a>
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
            <div slot="footer">
              <a @click="generar(2)" class="badge badge-light"><i class="fa fa-plus-square"></i> Ver más</a>
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
            <div slot="footer">
              <a @click="generar(3)" class="badge badge-light"><i class="fa fa-plus-square"></i> Ver más</a>
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
            <div slot="footer">
              <a @click="generar(4)" class="badge badge-light"><i class="fa fa-plus-square"></i> Ver más</a>
            </div>
          </stats-card>
        </a>
        </div>

      </div>
    </div>
    <div class="row" v-if="datosGLine.data!=null">
        <div class="col-md-8">
          <chart-card :datos="datosGLine" tipo="Line">
            <template slot="header">
              <h4 class="card-title">Ingresos</h4>
              <p class="card-category">Del 15 de mayo hasta hoy</p>
            </template>
            <template slot="footer">
              <div class="row">
                <div class="stats" style="padding:5px">
                  <a href="#" class="badge badge-secondary"><i class="fa fa-history"></i> Refrescar</a>
                </div>
                <div class="stats" style="padding:5px">
                  <a @click="generar(5)" class="badge badge-light"><i class="fa fa-plus-square"></i> Ver más</a>
                </div>
              </div>
            </template>
          </chart-card>
        </div>

        <div class="col-md-4">
        <a @click="generar(6)">
          <chart-card :datos="datosGPie" tipo="Pie">
            <template slot="header">
              <h4 class="card-title">% de Asistencia Del Mes Anterior</h4>
              <p class="card-category">Personal Operativo</p>
            </template>
            <template slot="footer">
              <div class="row">
                <div class="stats" style="padding:5px">
                  <a href="#" class="badge badge-secondary"><i class="fa fa-history"></i> Refrescar</a>
                </div>
                <div class="stats" style="padding:5px">
                  <a @click="generar(6)" class="badge badge-light"><i class="fa fa-plus-square"></i> Ver más</a>
                </div>
              </div>
            </template>
          </chart-card>
        </a>
        </div>
      </div>
      </div>
      </transition>
     <transition name="fade" mode="out-in" >
          <div  v-show="GraficaP!=null">
              <panel :consultaProp="consultaProp" :GraficaP="GraficaP" :user="userT"></panel>
          </div>
      </transition>
  </div>
</template>
<script type="text/javascript">
  import StatsCard from './Cards/StatsCard.vue'
  import ChartCard from './Cards/ChartCard.vue'
  import { EventBus } from '../event-bus.js'
  export default {
    components: {
      StatsCard,
      ChartCard
    },
    props:['user'],
    data () {
      return {
        GraficaP:null,
        ejecutados:0,
        abiertos:0,
        demorados:0,
        cancelados:0,
        consultaProp:null,
        algo:null,
        datosGPie:{
          data:[77,23],
          label:[],
          labels:["Asistencia","otro"]
        },
        datosGLine:{
          data:null,
          label:["AVCA"],
          labels:null
        },
        grafica1:[
          {
            titulo:"Vuelos Ejecutados Del 15 al 17 de Mayo",
            grafica:"Bar",
            datos:{
              labels:["15 Mayo","16 Mayo","17 Mayo"],
              label:["AVCA"],
              data:[[3,3,6]]
            }
          }
        ],
        consulta1:{
          consulta:"Servicios",
          parametros:['Vuelos'],
          filtrosV:['Ejecutados'],
          periodo:"Personalizado",
          desde:"2018-05-15",
          hasta:"2018-05-17"
        },
        grafica2:[
          {
            titulo:"Vuelos Abiertos Del 15 al 31 de Mayo",
            grafica:"Bar",
            datos:{
              labels:["18 Mayo","19 Mayo","20 Mayo","21 Mayo","22 Mayo","23 Mayo","24 Mayo","25 Mayo","26 Mayo","27 Mayo","28 Mayo","29 Mayo","30 Mayo","31 Mayo"],
              label:["AVCA"],
              data:[[1,13,6,12,18,20,5,7,5,3,4,17,7,5]]
            }
          }
        ],
        consulta2:{
          consulta:"Servicios",
          parametros:['Vuelos'],
          filtrosV:['Abiertos'],
          periodo:"Personalizado",
          desde:"2018-05-15",
          hasta:"2018-05-31"
        },
        grafica3:[
          {
            titulo:"Vuelos Demorados Del 15 al 17 de Mayo",
            grafica:"Bar",
            datos:{
              labels:["15 Mayo","16 Mayo","17 Mayo"],
              label:["AVCA"],
              data:[[1,3,2]]
            }
          }
        ],
        consulta3:{
          consulta:"Servicios",
          parametros:['Vuelos'],
          filtrosV:['Demorados'],
          periodo:"Personalizado",
          desde:"2018-05-15",
          hasta:"2018-05-17"
        },
        grafica4:[
          {
            titulo:"Vuelos Cancelados Del 15 al 31 de Mayo",
            grafica:"Bar",
            datos:{
              labels:["15 Mayo","16 Mayo","17 Mayo","18 Mayo","19 Mayo","20 Mayo","21 Mayo","22 Mayo","23 Mayo","24 Mayo","25 Mayo","26 Mayo","27 Mayo","28 Mayo","29 Mayo","30 Mayo","31 Mayo"],
              label:["AVCA"],
              data:[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]]
            }
          }
        ],
        consulta4:{
          consulta:"Servicios",
          parametros:['Vuelos'],
          filtrosV:['Cancelados'],
          periodo:"Personalizado",
          desde:"2018-05-15",
          hasta:"2018-05-31"
        },
        grafica5:[
        {
          titulo:"Ingresos Del 15 al 17 de Mayo",
          grafica:"Line",
          datos:{
            data:[[35200,32200,34800]],
            label:["AVCA"],
            labels:["15 Mayo","16 Mayo","17 Mayo"]
          }
        }],
        consulta5:{
          consulta:"Ingresos",
          periodo:"Personalizado",
          desde:"2018-05-15",
          hasta:"2018-05-17"
        },
        grafica6:[
        {
          titulo:"% de Asistencia Del Mes anterior",
          grafica:"Torta",
          datos:{
            data:[77,23],
            label:[],
            labels:["Asistencia","otro"]
          }
        }],
        consulta6:{
          consulta:"Personal",
          periodo:"Mes anterior",
          parametros:['Asistencias']
        },
      }
    },
    computed:{
    url: function() {
        return "http://"+window.location.host+'/reportes/panel';
      },
      userT: function() {
        return this.user
      }
    },
      methods:{
        generar(tipo){
          $('#reportesnav').removeClass('active');
          $('#panelnav').addClass('active');
          switch (tipo) {
            case 1:
              this.GraficaP=this.grafica1
              this.consultaProp=this.consulta1
              break;
            case 2:
              this.GraficaP=this.grafica2
              this.consultaProp=this.consulta2
              break;
            case 3:
              this.GraficaP=this.grafica3
              this.consultaProp=this.consulta3
              break;
            case 4:
              this.GraficaP=this.grafica4
              this.consultaProp=this.consulta4
              break;
            case 5:
              this.GraficaP=this.grafica5
              this.consultaProp=this.consulta5
              break;
            case 6:
              this.GraficaP=this.grafica6
              this.consultaProp=this.consulta6
              break;
          }
          EventBus.$emit('panel', true)
        },
        vuelos(estado){
          axios({
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
            });
        },
        ingresos(){
          var auxI="2018-05-15";
          var auxF="2018-05-17";
          var titulo="Ingresos Del 15 al 17 de Mayo";

          axios({
                method: 'get',
                url: '/reportes/api/ingresos/?inicio='+auxI+'&final='+auxF
            }).then((response) =>{
              this.datosGLine.data=[response.data.data]
              this.datosGLine.labels=response.data.labels
              this.datosGLine.titulo=titulo
              this.grafica5[0].datos.data=[response.data.data]
              this.grafica5[0].datos.labels=response.data.labels
              this.grafica5[0].titulo
              console.log(response.data)
            }).catch((err)=>{
                Vue.toasted.show('Ha ocurrido un error', {
                    theme: "primary", 
                  position: "bottom-right",  
                  duration : 2000
                });
                console.log(err);
            });
        }
      },
    created: function(){
      this.vuelos("ejecutado")
      this.vuelos("abierto")
      this.vuelos("demorado")
      this.vuelos("cancelado")
      this.ingresos()
      EventBus.$on('inicio', function (event) {
        this.GraficaP=null;
      }.bind(this));
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