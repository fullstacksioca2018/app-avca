import { Line } from '../BaseCharts'
import { reactiveProp } from '../mixins'

export default {
  mixins: [reactiveProp],
  extends: Line,
  mounted () {
    var background=['#7ECBD7',
            '#48B2E4',
            '#1C5281',
            '#912740',
            '#E04352',
            '#F29229',
            '#1b98d3',
            '#204568']
    console.log(this.chartData)
     if(this.chartData.label.length==1){
      this.renderChart({
        labels: this.chartData.labels,
        datasets: [
          {
            label: this.chartData.label[0],
            backgroundColor: '#007bff',
            data: this.chartData.data[0]
          }
        ]
      }, {responsive: true, maintainAspectRatio: false,
        tooltips: {
            bodyFontSize: 18
          }
        })
    }
    else{
      var datasets=[];
      for (var i = 0; i < this.chartData.label.length; i++) {
      if(i>7){
          j=i-8;
        }
        else{
          j=i;
        }
        datasets.push({
          label: this.chartData.label[i],
          backgroundColor: background[j],
          data: this.chartData.data[i]
        });
      }
      this.renderChart({
        labels: this.chartData.labels,
        datasets: datasets
      }, {responsive: true, maintainAspectRatio: false,
        tooltips: {
            bodyFontSize: 18
          }
        })
    }
  }
}
