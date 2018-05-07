import { Bar } from '../BaseCharts'
import { reactiveData } from '../mixins'

export default {
  extends: Bar,
  mixins: [reactiveData],
  data: () => ({
    chartData: '',
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  }),
  created () {
    this.fillData()
  },

  mounted () {
    this.renderChart(this.chartData, this.options)

    setInterval(() => {
      this.fillData()
    }, 5000)
  },

  methods: {
    fillData () {
      this.chartData = {
        labels: ['January' + this.getRandomInt(), 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#007bff',
            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
          }
        ]
      }
    },

    getRandomInt () {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5
    }
  }
}
