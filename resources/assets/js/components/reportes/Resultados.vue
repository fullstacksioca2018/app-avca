<template><div>
	<div class="container">
		<div class="list-container">
			<div v-for="(item, key) in graficas">
				<template slot="title">
		          <strong >{{ item.titulo }}</strong>
		        </template>
		        <div v-if="item.grafica=='Torta'">
					<div class="Chart">
				      <h1 style="text-align:center;">{{ item.titulo }}</h1>
			      		<pie-example :chart-data="item.datos"></pie-example>
				    </div>
				</div>
				<div v-if="item.grafica=='Line'">
					<div class="Chart">
				      <h1 style="text-align:center;">{{ item.titulo }}</h1>
				      <line-example :chart-data="item.datos"></line-example>
				    </div>
				</div>
				<div v-if="item.grafica=='Bar'">
					<div class="Chart">
				      <h1 style="text-align:center;">{{ item.titulo }}</h1>
		      		  <bar-example :chart-data="item.datos"></bar-example>
				    </div>
				</div>
				<div v-if="item.grafica=='BarG'">
					<div class="Chart">
				      <h1 style="text-align:center;">{{ item.titulo }}</h1>
		      		  <bargoup-example :chart-data="item.datos"></bargoup-example>
				    </div>
				</div>
			</div>
		</div>
		<scale-loader :loading="loading" :color="color" :height="height" :width="width"></scale-loader>
	</div>
	<modalDiagnoticar :datos="diagnostico"></modalDiagnoticar>
	<div class="row" style="margin-left:20px">
		<div v-if="tipoC=='Ingresos'">
			<button class="btn btn-primary" @click="pronosticar()">Pronosticar</button>
		</div>
		<div v-else>
			<button class="btn btn-primary" @click="cargar()">Diagnosticar</button>
		</div>
	</div></div>
</template>
<script type="text/javascript">
	import LineExample from './LineExample'
	import PieExample from './PieExample'
	import BarExample from './BarExample'
	import modalDiagnoticar from './modalDiagnoticar'
	import BargoupExample from './BargoupExample'
	import { EventBus } from '../event-bus.js'
	import { ScaleLoader } from 'vue-spinner/dist/vue-spinner.min.js'
	export default {
		props:['graficas','tipo'],
		components: {
			ScaleLoader,
			LineExample,
			PieExample,
			BarExample,
			BargoupExample,
			modalDiagnoticar
		},
		computed:{
			tipoC: function(){
				return this.tipo
			}
		},
		data() {
	        return {
	            tag:1,
				loading:false,
				color:"#4DBFEE",
				size:"5px",
				height:"50px",
				width:"8px",
				diagnostico:null
	        }
	    },
	    methods: {
			pronosticar(){
				this.graficas=[];
				this.loading=true;
				axios({
	                method: 'get',
	                url: '/reportes/api/ingresos/pronostico'
	            }).then((response) =>{
					this.loading=false;
	            	console.log('AQUI');
					var datos={labels:response.data.labels,label:["AVCA"],data:[response.data.data]}
						this.graficas.push({
						"titulo":"Pronostico De Ingresos",
						"grafica":"Bar",
						"datos":datos
					});
					console.log(response.data)
	            }).catch((err)=>{
	                Vue.toasted.show('Ha ocurrido un error', {
	                    theme: "primary", 
	                  position: "bottom-right",  
	                  duration : 2000
	                });
	                console.log(err);
	            });	
			},
	    	cargar(){
	      		EventBus.$emit('modalDiagnoticar', true)
	    	},
	        linkClass (idx) {
	            if (this.tabIndex === idx) {
	                return ['active']
	            } else {
	                return []
	            }
	        },
	    }

	}
</script>

