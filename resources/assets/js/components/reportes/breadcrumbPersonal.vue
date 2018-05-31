<template>
	<div class="content-header">
      <div class="container-fluid">
      	<div class="col-sm-12" v-if="items==1">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active" @click="generar()">Inicio</li>
            </ol>
          </div><!-- /.col -->
          <div v-else class="col-sm-12">
          	<ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item" @click="generar()">Inicio</li>
                <li class="breadcrumb-item active">Panel</li>
            </ol>
          </div>
      </div><!-- /.container-fluid -->
      <b-breadcrumb :items="items"/>
    </div>
</template>
<script type="text/javascript">
  import { EventBus } from '../event-bus.js'
  export default {
	 name:"breadcrumbpersonal",
	 data () {
      return {
      		items:1
      }
  	},
	 methods:{
	        generar(){
          $('#panelnav').removeClass('active');
            $('#reportesnav').addClass('active');
		        this.items=1;
            // history.pushState(null, "", "reportes");
	      		EventBus.$emit('inicio', true)
	        }
	    },
    created: function(){
	    	EventBus.$on('panel', function (event) {
		        this.items=2;
		        // history.pushState(null, "", "reportes/panel");
		      }.bind(this));
	    }
	}
</script>
<style type="text/css">
	li.breadcrumb-item{
		cursor: pointer;
	}
</style>