<template>
	<div>
		<div @click="Mactive()">
		<b-list-group-item href="#" class="d-flex justify-content-between align-items-center">
			<a class="d-flex align-items-center list-group-item-action" 
			:class="activo ? ' ' :'justify-content-between'" role="button" variant="primary">{{ titulo }} <b-badge variant="primary" pill>{{ ind }}</b-badge></a>
			    <b-card class="mt-2 col-md-9 col-4" v-show="activo" :class="color">
						    <b-list-group flush>
						    	<b-list-group-item href="#" class="d-flex justify-content-between align-items-center">Cargo 1 <b-badge variant="primary" pill>97%</b-badge></b-list-group-item>
						    	<b-list-group-item href="#" class="d-flex justify-content-between align-items-center">Cargo 2 <b-badge variant="primary" pill>87%</b-badge></b-list-group-item>
						    	<b-list-group-item href="#" class="d-flex justify-content-between align-items-center">Cargo 3 <b-badge variant="primary" pill>81%</b-badge></b-list-group-item>
						    </b-list-group>
			    </b-card>
      	</b-list-group-item>
	</div></div>
</template>

<script type="text/javascript">
export default {
	props:['datos','ind','titulo'],
	data(){
		return{
			activo:false
		}
	},
	methods:{
		Mactive(){
			this.activo=!this.activo;
		}
	}	
}
</script>

<style type="text/css">
	span.badge.badge-primary.badge-pill{
		margin-left: 10px;
	}
	a.list-group-item.d-flex.justify-content-between.align-items-center.list-group-item-action{
		text-decoration: none;
	}
</style>