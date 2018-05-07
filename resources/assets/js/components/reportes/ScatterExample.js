import { Scatter } from '../BaseCharts'

export default {
  extends: Scatter,
  mounted () {
    this.renderChart({
      datasets: [{
        label: 'Scatter Dataset 1',
        fill: false,
        borderColor: '#007bff',
        backgroundColor: '#007bff',
        data: [{
          x: -2,
          y: 4
        }, {
          x: -1,
          y: 1
        }, {
          x: 0,
          y: 0
        }, {
          x: 1,
          y: 1
        }, {
          x: 2,
          y: 4
        }]
      },
      {
        label: 'Scatter Dataset 2',
        fill: false,
        borderColor: '#7acbf9',
        backgroundColor: '#7acbf9',
        data: [{
          x: -2,
          y: -4
        }, {
          x: -1,
          y: -1
        }, {
          x: 0,
          y: 1
        }, {
          x: 1,
          y: -1
        }, {
          x: 2,
          y: -4
        }]
      }]
    }, {responsive: true, maintainAspectRatio: false})
  }
}
