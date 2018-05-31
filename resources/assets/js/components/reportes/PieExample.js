import { Pie } from '../BaseCharts'
import { reactiveProp } from '../mixins'

export default {
  mixins: [reactiveProp],
  extends: Pie,
  data () {
      return {
          datasets: [],
          background:[
                      '#1C5281',
                      '#48B2E4',
                      '#7ECBD7',
                      '#EEEEEE',
                      '#DD1B16',
                      '#007bff',
                      '#087574',
                      '#ff1B16']
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
  methods:{
    construir(){
      this.datasets=[];
      var j=0;
      var backgroundAux=[];
      for (var i = 0; i < this.datosN.labels.length; i++) {
        if(i>7){
            j=i-8;
        }
        else{
          j=i;
        }
        if(this.datosN.labels[i]!="otro")
          backgroundAux.push(this.background[j]);
        else
          backgroundAux.push('#e1e1e1');

      }
        this.datasets.push({
          backgroundColor: backgroundAux,
          data: this.datosN.data
        });
      },
    renderN(){
        console.log(this.datosN);
          this.construir();
          this.renderChart({
              labels: this.datosN.labels,
              datasets: this.datasets
            }, {responsive: true, maintainAspectRatio: false,
                tooltips: {
                  bodyFontSize: 18,
                  callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index] || '';
                            if (label) {
                                label += ': ';
                            }
                            label += Math.round(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] * 100) / 100;
                            label += '%';
                            return label;
                        } 
                    }
                }

            })
    }
  },
  mounted () {
    // console.log(this.chartData)
        this.renderN();
  }
}
