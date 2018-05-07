import { Bar } from '../BaseCharts'
import { reactiveProp } from '../mixins'

export default {
  mixins: [reactiveProp],
  extends: Bar,
  data () {
      return {
          datasets: [],
          background:['#7ECBD7',
            '#48B2E4',
            '#1C5281',
            '#912740',
            '#E04352',
            '#F29229',
            '#1b98d3',
            '#204568']
      }
  },
  methods:{
    renderN(){
      this.construir();
      this.renderChart({
        labels: this.datosN.labels,
        datasets: this.datasets
      }, {responsive: true, maintainAspectRatio: false,
        tooltips: {
            bodyFontSize: 18
          }
      })
    },
    construir(){
      this.datasets=[];
      var j=0;
      console.log(this.datosN);
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
          stack: this.datosN.stack[i],
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
