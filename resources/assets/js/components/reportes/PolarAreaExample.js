import { PolarArea } from '../BaseCharts'

export default {
  extends: PolarArea,
  mounted () {
    this.renderChart({
      labels: ['Cumaná', 'Caracas', 'Anzoateguis', 'Maturín', 'Maracaibo', 'Bolivar', 'Trujillo'],
      datasets: [
        {
          label: 'Asistencia o inasistencia por Sucursal o cargo',
          backgroundColor: 'rgb(7, 114, 228,0.5)',
          pointBackgroundColor: 'rgb(7, 114, 228,1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgb(7, 114, 228,1)',
          data: [75, 69, 10, 51, 26, 77, 93]
        }// ,
        // {
        //   label: 'My Second dataset',
        //   backgroundColor: 'rgba(255,99,132,0.2)',
        //   pointBackgroundColor: 'rgba(255,99,132,1)',
        //   pointBorderColor: '#fff',
        //   pointHoverBackgroundColor: '#fff',
        //   pointHoverBorderColor: 'rgba(255,99,132,1)',
        //   data: [28, 48, 40, 19, 96, 27, 100]
        // }
      ]
    }, {responsive: true, maintainAspectRatio: false})
  }
}
