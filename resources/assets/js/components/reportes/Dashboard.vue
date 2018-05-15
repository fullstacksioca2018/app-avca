<template>
  <div class="content">
    <div class="card">
      <div class="card-header text-center">
          <strong>Vuelos De la Quincena</strong>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <stats-card colorB="CardEjecutados" colorI="CardEjecutadosL">
            <div slot="header" class="icon-warning">
              <i class="fa fa-check-square-o fa-5x"></i>
            </div>
            <div slot="content">
              <p class="card-category marginLe">Ejecutados</p>
              <h4 class="card-title">12</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-plus-square"></i> Ver más
            </div>
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card colorB="CardAbiertos" colorI="CardAbiertosL">
            <div slot="header" class="icon-success">
              <i class="fa fa-line-chart fa-5x"></i>
            </div>
            <div slot="content">
              <p class="card-category marginLe">Abiertos</p>
              <h4 class="card-title">120</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-plus-square"></i> Ver más
            </div>
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card colorB="CardDemorados" colorI="CardDemoradosL">
            <div slot="header" class="icon-danger">
              <i class="fa fa-clock-o fa-5x"></i>
            </div>
            <div slot="content">
              <p class="card-category marginLe">Demorados</p>
              <h4 class="card-title">3</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-plus-square"></i> Ver más
            </div>
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card colorB="CardCancelados" colorI="CardCanceladosL">
            <div slot="header" class="icon-info">
              <i class="fa fa-times fa-5x"></i>
            </div>
            <div slot="content">
              <p class="card-category marginLe">Cancelados</p>
              <h4 class="card-title">0</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-plus-square"></i> Ver más
            </div>
          </stats-card>
        </div>

      </div>
    </div>
    <div class="row">
        <div class="col-md-8">
          <chart-card :datos="datosGLine" tipo="Line">
            <template slot="header">
              <h4 class="card-title">Ingresos</h4>
              <p class="card-category">Del 10 de mayo hasta hoy</p>
            </template>
            <template slot="footer">
              <div class="row">
                <div class="stats" style="padding:5px">
                  <i class="fa fa-history"></i> Refrescar
                </div>
                <div class="stats" style="padding:5px">
                  <i class="fa fa-plus-square"></i> Ver más
                </div>
              </div>
            </template>
          </chart-card>
        </div>

        <div class="col-md-4">
          <chart-card :datos="datosGPie" tipo="Pie">
            <template slot="header">
              <h4 class="card-title">Asistencia Actual</h4>
              <p class="card-category">Personal Operativo</p>
            </template>
            <template slot="footer">
              <div class="row">
                <div class="stats" style="padding:5px">
                  <i class="fa fa-history"></i> Refrescar
                </div>
                <div class="stats" style="padding:5px">
                  <i class="fa fa-plus-square"></i> Ver más
                </div>
              </div>
            </template>
          </chart-card>
        </div>
      </div>
  </div>
</template>
<script type="text/javascript">
  import StatsCard from './Cards/StatsCard.vue'
  import ChartCard from './Cards/ChartCard.vue'
  export default {
    components: {
      StatsCard,
      ChartCard
    },
    data () {
      return {
        algo:null,
        datosGPie:{
          data:[77,23],
          label:[],
          labels:["Asistencia","otro"]
        },
        datosGLine:{
          data:[[35200,43800,32200,35000]],
          label:["AVCA"],
          labels:["10 Mayo","11 Mayo","12 Mayo","13 Mayo"]
        }
        ejecutados:null,
        abiertos:null,
        demorados:null,
        cancelados:null
      },
      methods:{
        vuelos(estado){
          url='/api/reporte/vuelos/'+estado;
          axios({
                method: 'get',
                url: url       
            }).then((response) =>{
                this.ejecutados=response.data;
            }).catch((err)=>{
                Vue.toasted.show('Ha ocurrido un error', {
                    theme: "primary", 
                  position: "bottom-right",  
                  duration : 2000
                });
                console.log(err);
            });
        }
      }
    },
    created: function(){
      this.vuelos("abierto")
      this.vuelos("ejecutado")
      this.vuelos("retrasado")
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
</style>