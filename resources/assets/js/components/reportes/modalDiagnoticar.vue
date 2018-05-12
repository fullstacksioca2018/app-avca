
<template>
  <div id="ContenedormodalDiagnoticar">
    <b-modal ref="modalDiagnoticar" hide-footer hide-header size="lg" body-bg-variant="light">
      <div class="d-block text-center">
      	<scale-loader :loading="loading" :color="color" :height="height" :width="width"></scale-loader>
      	<div v-if="datos!=null">
      		Hay datos
      	</div>
      	<div v-else>
			<b-tabs>
			 	<b-tab active>
				   <template slot="title">
				     Asistencia <strong>Mayor a 80%</strong>
				   </template>
		      		<b-card no-body>
					    <b-list-group flush>
					      <ItemGroup :datos="DatosItem" ind="95%" titulo="Sucursal 1" color="alert-info"></ItemGroup>
					      <ItemGroup :datos="DatosItem" ind="89%" titulo="Sucursal 2"></ItemGroup>
					      <ItemGroup :datos="DatosItem" ind="82%" titulo="Sucursal 3"></ItemGroup>
					    </b-list-group>
					    <b-card-body class="alert-info">
					      Buen Rendimiento
					    </b-card-body>
				  </b-card>
			    </b-tab>
			    <b-tab >
				   <template slot="title">
				     Asistencia <strong>Sobre la Media</strong>
				   </template>
			      		<b-card no-body>
						    <b-list-group flush>
						      <ItemGroup :datos="DatosItem" ind="75%" titulo="Sucursal 4" color="alert-primary"></ItemGroup>
						      <ItemGroup :datos="DatosItem" ind="64%" titulo="Sucursal 5"></ItemGroup>
						      <ItemGroup :datos="DatosItem" ind="52%" titulo="Sucursal 6"></ItemGroup>
						    </b-list-group>
						    <b-card-body class="alert-primary">
						      Buen Rendimiento
						    </b-card-body>
					  </b-card>
			    </b-tab>
			    <b-tab >
				   <template slot="title">
				     Asistencia <strong>Bajo</strong>
				   </template>
				   <b-card no-body>
					    <b-list-group flush>
					      <ItemGroup :datos="DatosItem" ind="42%" titulo="Sucursal 7"></ItemGroup>
					      <ItemGroup :datos="DatosItem" ind="29%" titulo="Sucursal 8"></ItemGroup>
					      <ItemGroup :datos="DatosItem" ind="22%" titulo="Sucursal 9"></ItemGroup>
					    </b-list-group>
					    <b-card-body class="alert-secondary">
					      Mal Rendimiento, <strong>MEDIDAS</strong>
					    </b-card-body>
					</b-card>
			    </b-tab>
			</b-tabs>
      	</div>
      </div>
      <b-btn size="md" class="float-right" variant="outline-info" @click="hideModal">
           Regresar
         </b-btn>
    </b-modal>
  </div>
</template>
<script type="text/javascript">
import { EventBus } from '../event-bus.js'
import { ScaleLoader } from 'vue-spinner/dist/vue-spinner.min.js'
import ItemGroup from './ItemGroup.vue'
export default {
	props:['datos'],
	components: {
		ScaleLoader,
		ItemGroup
	},
	data(){
		return{
			loading:false,
			color:"#4DBFEE",
			size:"5px",
			height:"50px",
			width:"8px",
			active:[true,true,true],
			activeTWO:true,
			DatosItem:null
		}
	},
	created: function(){	
			    EventBus.$on('modalDiagnoticar', function (event) {
			      this.$refs.modalDiagnoticar.show();
			    }.bind(this));
			},
	methods: {
		showModal () {
			this.$refs.modalDiagnoticar.show()
		},
		hideModal () {
			this.$refs.modalDiagnoticar.hide()
		}
	}
};

	
</script>
<style type="text/css">
	#ContenedormodalDiagnoticar header.card-header.p-1{
		padding: 0px !important;
		opacity: 0.9;
	}
	#ContenedormodalDiagnoticar header.card-header.p-1:hover{
		opacity: 1;
	}
</style>