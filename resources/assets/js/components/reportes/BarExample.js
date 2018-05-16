import { Bar } from '../BaseCharts'
import { reactiveProp } from '../mixins'

export default {
  mixins: [reactiveProp],
  extends: Bar,
  data () {
      return {
          datasets: [],
          background:['#41B883',
                      '#E46651',
                      '#00D8FF',
                      '#DD1B16',
                      '#41B883',
                      '#007bff',
                      '#087574',
                      '#ff1B16']
      }
  },
  methods:{
    renderN(){
      this.construir();
      console.log(this.datosN);
      this.renderChart({
        labels: this.datosN.labels,
        datasets: this.datasets,
      }, {responsive: true, maintainAspectRatio: false,
        tooltips: {
            bodyFontSize: 18
          },
          beginAtZero: true,
          scales: {
          yAxes: [{
            stacked: true,
            ticks: {
              beginAtZero: true
            }
          }],
          xAxes: [{
            stacked: true,
            ticks: {
              beginAtZero: true
            }
          }]

        }
        })
    },
    construir(){
      this.datasets=[];
      var j=0;
      for (var i = 0; i < this.datosN.label.length; i++) {
        if(i>7){
            j=i-8;
        }
        else{
          j=i;
        }
        this.datasets.push({
          label: this.datosN.label[i],
          backgroundColor: this.background[j],
          data: this.datosN.data[i]
        });
      }
    }
  },
  computed:{
    datosN: function() {
          return this.chartData;
        }
  },
  watch:{
      'datosN': function () {
        this.beforeDestroyP();
        this.renderN();
      }
    },
  mounted () {
    this.renderN();
  }
}
