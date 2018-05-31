import { Line } from '../BaseCharts'
import { reactiveProp } from '../mixins'

export default {
  mixins: [reactiveProp],
  extends: Line,
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
  },
  methods:{
    renderN(){
        var background=['#7ECBD7',
            '#48B2E4',
            '#1C5281',
            '#912740',
            '#E04352',
            '#F29229',
            '#1b98d3',
            '#204568']
         if(this.datosN.label.length==1){
          this.renderChart({
            labels: this.datosN.labels,
            datasets: [
              {
                label: this.datosN.label[0],
                pointHoverBorderColor:"#000",
                pointBackgroundColor: "#345345",
                pointBorderColor: "#eee",
                backgroundColor:"#1C5281",
                borderColor:"#345345",
                pointRadius: 4,
                pointHoverRadius: 6,
                lineSmooth: true,
                showLine: true,
                showPoint: true,
                fullWidth: true,
                data: this.datosN.data[0]
              }
            ]
          }, {responsive: true, maintainAspectRatio: false,
            tooltips: {
                bodyFontSize: 18
              },
            })
        }
        else{
          var datasets=[];
          for (var i = 0; i < this.datosN.label.length; i++) {
          if(i>7){
              j=i-8;
            }
            else{
              j=i;
            }
            datasets.push({
              label: this.datosN.label[i],
              backgroundColor: background[j],
              data: this.datosN.data[i]
            });
          }
          this.renderChart({
            labels: this.datosN.labels,
            datasets: datasets
          }, {responsive: true, maintainAspectRatio: false,
            tooltips: {
                bodyFontSize: 18
              },
              options: {
                low: 0,
                high: 800,
                showArea: false,
                height: '245px',
                axisX: {
                  showGrid: false
                },
                lineSmooth: true,
                showLine: true,
                showPoint: true,
                fullWidth: true,
                chartPadding: {
                  right: 50
                }
              }
            })
        }
    }
  }
}
