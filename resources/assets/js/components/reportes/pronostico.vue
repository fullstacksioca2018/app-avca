<template>
	<div class="container">
		<div class="row">
			<div class="col-3">
				<b-form-group label="Parámetros">
			      <b-form-checkbox-group stacked v-model="form.parametros" name="flavour2" :options="parametros">
			      </b-form-checkbox-group>
			    </b-form-group>
	    	</div>
	    	 <!-- Filtros -->
		    <div class="col-9">
		    	<div v-if="filtros!=null">
		    		 <div>
						  <legend class="typo__label">Filtros</legend>
						  <multiselect v-model="form.filtros" :options="filtros" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar">
						    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
						  </multiselect>
					</div>
		    	</div>
			    <div v-if="form.filtros!=null">
			    	<!-- <div class="form-row"> -->
			    	<div v-for="filtroA in form.filtros">
				    	<b-form-group :label="filtroA">
							<multiselect v-if="filtroA=='Origen'" v-model="form.datosf[filtroA]" :options="opciones.Origen" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Sucursal Origen" :preselect-first="false" selectLabel="Seleccionar">
						    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
							</multiselect>
							<multiselect v-if="filtroA=='Destino'" v-model="form.datosf[filtroA]" :options="opciones.Destino" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Sucursal Destino" :preselect-first="false" selectLabel="Seleccionar">
						    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
							</multiselect>
							<multiselect v-if="filtroA=='Ruta'" v-model="form.datosf[filtroA]" :options="opciones.Ruta" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Ruta" :preselect-first="false" selectLabel="Seleccionar">
						    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
							</multiselect>
							<multiselect v-if="filtroA=='Edad'" v-model="form.datosf[filtroA]" :options="opciones.Edad" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione la Edad" :preselect-first="false" selectLabel="Seleccionar">
						    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
							</multiselect>
							<multiselect v-if="filtroA=='Genero'" v-model="form.datosf[filtroA]" :options="opciones.Generos" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione el Genero" :preselect-first="false" selectLabel="Seleccionar">
						    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
							</multiselect>
						</b-form-group>
			    	</div>
			    </div>
			</div>
		</div>
		<div class="container m-auto">
	          <button type="submit" class="btn btn-info btn-md btn-center" @click="pronosticar()">
	            <i class="fa fa-check"></i> Pronósticar
	          </button>
	    </div>
	    <div class="card" v-if="!loading">
	    	<div class="card-block">
	    		<transition name="fade"  mode="in-out">
					<div v-show="graficas.length>=1">
			        	<Resultados :graficas="graficas" :tipo="form.consulta"></Resultados>
			        </div>
		    	</transition>
	    	</div>
	    </div>
	</div>
</template>
<script type="text/javascript">
import Resultados from './Resultados'
import Multiselect from 'vue-multiselect'
import { ScaleLoader } from 'vue-spinner/dist/vue-spinner.min.js'
	export default {
		components: {
		  Resultados,
		  Multiselect,
		  ScaleLoader,
	    },
	    props:['GraficaP','user','consultaProp'],
		data () {
			return {
				form:{
					parametros:[],
					filtros:[],
					datosf:[],
					edadesF:[],
					generosF:[],
					origenesF:[],
					destinosF:[],
					rutasF:[]
				},
				P:[
					'Bebe','Niños','Adolecente','Adulto'
				],
				G:[
					'Mujer','Hombre'
				],
				graficas:[],
				tipos:[	],
				parametros:[ 'Vuelos','Pasajeros','Ingresos'/*,'Vacaciones'*/
				],
				filtrosV:['Origen','Destino','Ruta'/*,'Vacaciones'*/
				],
				filtrosP:['Ruta','Destino','Origen','Genero','Edad'
				],
				filtrosI:['Origen','Destino','Ruta'
				],
				filtros:[
					"Origen","Destino",'Ruta'
				],
				opciones:{
					Generos:['Mujer','Hombre'],
					Edad:['Bebe','Niños','Adolecente','Adulto'],
					Sucursal:[],
					Origen:[],
					Destino:[],
					Ruta:[],
				},
				loading:false,
			}
		},
		created: function(){
            this.CargarSucursales();
            this.CargarRutas();
        },
		methods:{
			validarGG(){
				console.log(this.form.filtros)
				if(this.form.parametros.length>=1){
					if(this.form.filtros.length>=1){
						for (var i = 0; i < this.form.filtros.length; i++) {
			     			if(!(this.form.datosf[this.form.filtros[i]])){
			     				var text="Ingrese "+this.form.filtros[i]+" para filtrar";
			     				Vue.toasted.show(text, {
			                        theme: "primary", 
				                    position: "bottom-right",  
				                    duration : 2000
			                    });
			                    return false;
			     			}
			     			else{
			     				if(this.form.datosf[this.form.filtros[i]].length==0){
			     					var text="Ingrese "+this.form.filtros[i]+" para filtrar";
				     				Vue.toasted.show(text, {
				                        theme: "primary", 
					                    position: "bottom-right",  
					                    duration : 2000
				                    });
				                    return false;
			     				}
			     			}
			     			
			     		}
					}
				}
				else{
					Vue.toasted.show("Debe seleccionar un parametro para la proyección", {
	                        theme: "primary", 
		                    position: "bottom-right",  
		                    duration : 2000
	                    });
						return false;
				}
				return true;
			},
			pronosticar(){
				this.graficas=[];
				if(this.validarGG()){
					// this.loading=true;
	    //     		let loader = this.$loading.show();
					// axios({
		   //              method: 'get',
		   //              url: '/reportes/api/ingresos/pronostico'
		   //          }).then((response) =>{
					// 	this.loading=false;
	    //         		loader.hide();
					// 	var datos={labels:response.data.labels,label:["AVCA"],data:[response.data.data]}
					// 		this.graficas.push({
					// 		"titulo":"Pronostico De Ingresos",
					// 		"grafica":"Bar",
					// 		"datos":datos
					// 	});
					// 	console.log(response.data)
		   //          }).catch((err)=>{
	    //         		loader.hide();
		   //              Vue.toasted.show('Ha ocurrido un error', {
		   //                  theme: "primary", 
		   //                position: "bottom-right",  
		   //                duration : 2000
		   //              });
		   //              console.log(err);
		   //          });	
				}
			},
			CargarSucursales(){
				axios({
                    method: 'get',
                    url: '/sucursales/all'       
                }).then((response) =>{
                    this.formatosucursal(response);
                }).catch((err)=>{
                    Vue.toasted.show('Ha ocurrido un error', {
                        theme: "primary", 
	                    position: "bottom-right",  
	                    duration : 2000
                    });
                    console.log(err);
                });
			},
			CargarRutas(){
				axios({
                    method: 'get',
                    url: '/reportes/api/rutas'       
                }).then((response) =>{
                    this.formatorutas(response);
                }).catch((err)=>{
                    Vue.toasted.show('Ha ocurrido un error', {
                        theme: "primary", 
	                    position: "bottom-right",  
	                    duration : 2000
                    });
                    console.log(err);
                });
			},
			formatocargos(data){
                for (var i= 0; i < data.data.length; i++){
					this.opciones.Cargo.push(data.data[i].titulo);
				}
			},
			formatorutas(data){
                for (var i= 0; i < data.data.length; i++){
					this.opciones.Ruta.push(data.data[i]);
				}
			},
			formatosucursal(data){
				 //Anadir datos
                for (var i= 0; i < data.data.length; i++){
                    this.opciones.Sucursal.push(data.data[i].nombre);
                    this.opciones.Origen.push(data.data[i].nombre);
                    this.opciones.Destino.push(data.data[i].nombre);
                }
			},
			ActualizarFiltros(){
				switch (this.form.parametros[0]) {
					case "Vuelo":
						this.filtros=this.filtrosV
						// statements_1
						break;
					case "Pasajeros":
						this.filtros=this.filtrosP
						// statements_1
						break;
					case "Ingresos":
						this.filtros=this.filtrosI
						// statements_1
						break;
				}
			}
        },
        watch:{
			'form.parametros': function(){
				if(this.form.parametros.length>1){
					var auxP=this.form.parametros[1];
					this.form.parametros[0]=auxP;
					this.form.parametros.splice(1,1);
				}
				this.ActualizarFiltros();
			},
        }
	}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style type="text/css">
	.multiselect__tag{
		font-size: 1.2rem;
	}
	legend {
		font-weight: 700;
	}
	span.custom__remove{
		margin-left: 10px;
	}
	#Busqueda .multiselect__single{
		font-size: 1.2rem;
		position: relative;
	    display: inline-block;
	    padding: 4px 26px 4px 10px;
	    border-radius: 5px;
	    margin-right: 10px;
	    color: #fff;
	    line-height: 1;
	    background: #41b883;
	    margin-bottom: 5px;
	    white-space: nowrap;
	    overflow: hidden;
	    max-width: 100%;
	    text-overflow: ellipsis;
	}
	.sinpadding{
		padding-left: 0px !important;
    	padding-right: 0px !important;
	}
	.paddingLnode{    
		padding-right: 0px !important;
	    font-weight: 700;
	    line-height: 3;
	}
	.marginCero{
		margin-right: 0px !important;
		margin-left: 0px !important;
	}

	.btn-center{
		display: block;
		margin-right: auto;
		margin-left: auto;
		margin-top: 20px;
		margin-bottom: 20px;
	}
	#flex-Perso .input-group{
		flex-wrap: inherit;
	}
	#panel > div > div > div.col > label{
		font-weight: 700;
	}
	#flex-Perso > div{
		margin-top: 6px;
	}

	.fade-enter-active {
	  transition: all 1s cubic-bezier(.2, 0.3, 0.4, .1);
	}
	.fade-leave-active {
	  transition: all 0.1s;
	}
	.fade-enter, .fade-leave-to {
	  transform: translateX(5px);
	  opacity: 0;
	}


	.fade-button-enter-active {
	  transition: all .1s ease;
	}
	.fade-button-leave-active {
	  transition: all .6s cubic-bezier(.1, 0.2, 0.2, .1);
	}
	.fade-button-enter, .fade-button-leave-to {
	  transform: translateX(2px);
	  opacity: 0;
	}

</style>