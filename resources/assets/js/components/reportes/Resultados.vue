<template>
	<div class="container">
		<!-- <b-tabs v-model="tag">
			<div v-for="(item, key) in graficas">
		      <b-tab :title-link-class="linkClass(key)">
		        <template slot="title">
		          <strong >{{ item.titulo }}</strong>
		        </template>
		        <div v-if="item.grafica=='Torta'">
					<div class="Chart">
				      <h1 style="text-align:center;">{{ item.titulo }}</h1>
			      		<pie-example></pie-example>
				    </div>
				</div>
				<div v-if="item.grafica=='Line'">
					<div class="Chart">
				      <h1 style="text-align:center;">{{ item.titulo }}</h1>
				      <line-example></line-example>
				    </div>
				</div>
		      </b-tab>
			</div>
		</b-tabs> -->
		<!-- <pre>{{ graficas[0].datos}}</pre> -->
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
</template>
<script type="text/javascript">
  import LineExample from './LineExample'
  import PieExample from './PieExample'
  import BarExample from './BarExample'
  import BargoupExample from './BargoupExample'
	export default {
		props:['graficas'],
		components: {
			LineExample,
			PieExample,
			BarExample,
			BargoupExample
		},
		data() {
	        return {
	            tag:1
	        }
	    },
	    methods: {
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