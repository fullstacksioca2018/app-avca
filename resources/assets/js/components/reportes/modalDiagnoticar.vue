
<template>
  <div id="ContenedormodalDiagnoticar">
    <b-modal ref="modalDiagnoticar" hide-footer hide-header size="lg" body-bg-variant="light">
      <div class="d-block text-center">
      	<scale-loader :loading="loading" :color="color" :height="height" :width="width"></scale-loader>
      	<div v-if="datos!=null">
      		Hay datos
      	</div>
      	<div v-else>
      		<h3 class="text-center">Estado de Asistencia</h3>
			<div role="tablist">
			    <b-card no-body class="mb-1">
			      <b-card-header header-tag="header" class="p-1" role="tab">
			        <b-btn block href="#" v-b-toggle.accordion1 variant="primary">Asistencia Mayor a 80%</b-btn>
			      </b-card-header>
			      <b-collapse id="accordion1" visible accordion="my-accordion" role="tabpanel" class="alert alert-primary">
			      		<b-card no-body>
						    <b-list-group flush>
						      <ItemGroup :datos="DatosItem" ind="95%" titulo="Sucursal 1" color="alert-primary"></ItemGroup>
						      <ItemGroup :datos="DatosItem" ind="89%" titulo="Sucursal 2"></ItemGroup>
						      <ItemGroup :datos="DatosItem" ind="82%" titulo="Sucursal 3"></ItemGroup>
						    </b-list-group>
						    <b-card-body class="alert-primary">
						      Buen Rendimiento
						    </b-card-body>
						  </b-card>
			      </b-collapse>
			    </b-card>
			    <b-card no-body class="mb-1">
			      <b-card-header header-tag="header" class="p-1" role="tab">
			        <b-btn block href="#" v-b-toggle.accordion2 variant="info" >Asistencia Sobre la Media</b-btn>
			      </b-card-header>
			      <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel" class="alert alert-info">
			      	<b-card no-body>
					    <b-list-group flush>
					      <ItemGroup :datos="DatosItem" ind="75%" titulo="Sucursal 4" color="alert-info"></ItemGroup>
					      <ItemGroup :datos="DatosItem" ind="64%" titulo="Sucursal 5"></ItemGroup>
					      <ItemGroup :datos="DatosItem" ind="52%" titulo="Sucursal 6"></ItemGroup>
					    </b-list-group>
					    <b-card-body class="alert-info">
					      Buen Rendimiento
					    </b-card-body>
					  </b-card>
			      </b-collapse>
			    </b-card>
			    <b-card no-body class="mb-1">
			      <b-card-header header-tag="header" class="p-1" role="tab">
			        <b-btn block href="#" v-b-toggle.accordion3 variant="secondary">Asistencia Bajo</b-btn>
			      </b-card-header>
			      <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel" class="alert alert-secondary">
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
			      </b-collapse>
			    </b-card>
			  </div>
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