<template>
	<div class="card">
	    <div class="card-header">
	      <h2 class="form-title">Reportes y Estadisticas</h2>
	    </div>
    	<div class="card-block">
			<div id="panel">
				<!-- Tipo de Consulta -->
				<b-form-group label="Tipo de Consulta">
			      <b-form-radio-group id="btnradios1"
			                          buttons
			                          v-model="form.consulta"
			                          :options="tipos"
			                          name="radiosBtnDefault" />
			    </b-form-group>
			    <!-- Parametros-->
			    <div class="form-row">
			    	<div class="col-3">
						<b-form-group :label="'Parametros '+ tipo">
					      <b-form-checkbox-group stacked v-model="form.parametros" name="flavour2" :options="parametros" :state="stateParametros">
					      </b-form-checkbox-group>
					    </b-form-group>
			    	</div>
			    	<!-- Lapso de Tiempo -->
			    	<div class="col-3">
					     <b-form-group label="Fecha">
					      <b-form-radio-group v-model="form.periodo"
					                          :options="optionsP"
					                          stacked
					                          name="radiosStacked">
					      </b-form-radio-group>
					    </b-form-group>
			    	</div>
				    <!-- Filtros -->
				    <div class="col-6">
				    	<div v-if="filtros!=null">
				    		 <div>
								  <label class="typo__label">Otros Filtros</label>
								  <multiselect v-model="form.filtros" :options="filtros" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar">
								    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
								  </multiselect>
							</div>
				    	</div>
				    	<div v-if="filtrosPjr!=null">
				    		 <!-- <legend>Filtros Pasajeros</legend>
						    <b-form-select multiple :select-size="4" v-model="form.filtrosP" :options="filtrosPjr" class="mb-3">
					    	</b-form-select> -->
					    	<div>
								  <legend class="typo__label">Filtros Pasajeros</legend>
								  <multiselect v-model="form.filtrosP" :options="filtrosPjr" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar">
								    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
								  </multiselect>
							</div>
				    		 

				    	</div>
					    <div v-if="form.filtros!=null">
					    	<!-- <div class="form-row"> -->
					    	<div v-for="filtroA in form.filtros">
						    	<b-form-group :label="filtroA">
						    		<multiselect v-if="filtroA=='Cargo'" v-model="form.datosf[filtroA]" :options="opciones.Cargo" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
								    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
								  </multiselect>
									<!-- <b-form-select multiple :select-size="4" v-if="filtroA=='Cargo'" v-model="form.datosf[filtroA]" :options="opciones.Cargo" class="mb-3" >
									</b-form-select> -->
									<multiselect v-if="filtroA=='Sucursal'" v-model="form.datosf[filtroA]" :options="opciones.Sucursal" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
								    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
									</multiselect>
									<!-- <b-form-select multiple :select-size="4" v-if="filtroA=='Sucursal'" v-model="form.datosf[filtroA]" :options="opciones.Sucursal" class="mb-3" >
									</b-form-select> -->
									<multiselect v-if="filtroA=='Origen'" v-model="form.datosf[filtroA]" :options="opciones.Origen" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
								    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
									</multiselect>
									<!-- <b-form-select multiple :select-size="4" v-if="filtroA=='Origen'" v-model="form.datosf[filtroA]" :options="opciones.Origen" class="mb-3" >
									</b-form-select> -->
									<multiselect v-if="filtroA=='Destino'" v-model="form.datosf[filtroA]" :options="opciones.Destino" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
								    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
									</multiselect>
									<!-- <b-form-select multiple :select-size="4" v-if="filtroA=='Destino'" v-model="form.datosf[filtroA]" :options="opciones.Destino" class="mb-3" >
									</b-form-select> -->
									<multiselect v-if="filtroA=='Ruta'" v-model="form.datosf[filtroA]" :options="opciones.Ruta" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
								    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
									</multiselect>
									<!-- <b-form-select multiple :select-size="4" v-if="filtroA=='Ruta'" v-model="form.datosf[filtroA]" :options="opciones.Ruta" class="mb-3" >
									</b-form-select> -->
								</b-form-group>
					    	</div>
					    <!-- </div> -->
					    </div>
					</div>
			    </div>
			    <div class="form-row" v-if="form.periodo=='Temporada'">
			    	<div class="col-4" >
			    		 <legend>Temporada</legend>
			    		 <multiselect v-model="form.temporadas" :options="opcionesT" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
					    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
						</multiselect>
					    <!-- <b-form-select multiple :select-size="4" v-model="form.temporadas" :options="opcionesT" class="mb-3">
				    	</b-form-select> -->
			    	</div>
			    	<div class="col-2" >
			    		 <legend>Año</legend>
			    		 <multiselect v-model="form.year" :options="year" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
					    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fas fa-times-circle"></i></span></span></template>
						</multiselect>
					    <!-- <b-form-select multiple :select-size="4" v-model="form.year" :options="year" class="mb-3"> -->
				    	</b-form-select>
			    	</div>
				</div>
			    <div class="form-row" v-if="form.periodo=='Personalizado'">
			    	<div class="col-md-4">
			              <label for="fecha_ingreso">Desde</label>
			              <div class="input-group">
			              	<b-form-input v-model="form.desde" type="date">
						      </b-form-input>
			                <div class="input-group-append">
			                  <span class="input-group-text">
			                    <i class="fas fa-calendar"></i>
			                  </span>
			                </div>
			              </div>
			            </div>
			            <div class="col-md-4">
			              <label for="fecha_ingreso">Hasta</label>
			              <div class="input-group">
			                <b-form-input v-model="form.hasta" type="date">
						      </b-form-input>
			                <div class="input-group-append">
			                  <span class="input-group-text">
			                    <i class="fas fa-calendar"></i>
			                  </span>
			                </div>
			              </div>
			            </div>
			    </div><br>
			<div class="row">
	          <div class="col-12">
	            <div class="form-group">
	              <button type="submit" class="btn btn-success" @click="generar()">
	                <i class="fas fa-check"></i>Generar
	              </button>
	              <button type="reset" class="btn btn-danger">
	                <i class="fas fa-eraser"></i> Limpiar
	              </button>
	            </div>
	          </div>
	        </div>
		</div>
	</div>
	<div class="card">
    	<div class="card-block">
			<div v-show="graficas.length>=1">
	        	<Resultados :graficas="graficas"></Resultados>
	        </div>
    	</div>
    </div>
</div>
</template>
<script type="text/javascript">
import Resultados from './Resultados'
import Multiselect from 'vue-multiselect'
	export default {
		components: {
		  Resultados,
		  Multiselect 
	    },
		data () {
			return {
				dataPoints: null,
        		height: 20,
				datos:[23,21,12,43],
				form:{
					consulta:"Personal",
					parametros:[],
					periodo:"Actual",
					filtros:[],
					filtrosP:[],
					datosf:[],
					desde:null,
					hasta:null,
					temporadas:[],
					year:["2017"]
				},
				filtrosPjr:null,
				P:[
					'Bebe','Niños','Adolecente','Adulto','Discapacitado'
				],
				filtrosV:null,
				V:[
					'Origen', 'Destino','Ruta'
				],
				year:["2013","2014","2015","2016","2017"
				],
				opcionesT:[ 'Decembrina','Semana Santa','Carnavales'
				],
				graficas:[],
				tipos:['Personal','Ingresos','Servicios'
				],
				parametros:[ 'Asistencias','Inasistencias','Licencias','Vacaciones'
				],
				parametrosP:['Asistencias','Inasistencias','Licencias','Vacaciones'
				],
				parametrosI:['Ruta','Destino','Origen'
				],
				parametrosS:['Vuelos','Pasajeros'
				],
				optionsP:['Actual','Semana anterior','Mes anterior','Temporada','Personalizado'
				],
				filtros:[
					"Cargo","Sucursal"
				]
    // ][
				// 	{text: 'Cargo', value: 'Cargo'},
				// 	{text: 'Sucursal', value: 'Sucursal'}
				// ]
				,
				filtrosP:['Cargo','Sucursal'
				],
				filtrosS:['Origen','Destino','Ruta'
				],
				tipo: "Del Personal",
				opciones:{
					Cargo:[ 'Cargo 1','Cargo 2','Cargo 3'
					],
					Sucursal:['Sucursal 1','Sucursal 2','Sucursal 3'
					],
					Origen:['Origen 1','Origen 2','Origen 3'
					],
					Destino:['Destino 1','Destino 2','Destino 3'
					],
					Ruta:['Ruta 1','Ruta 2', 'Ruta 3'
					],
				},
			}
		},
		computed: {
	      myStyles () {
	        return {
	          height: `${this.height}px`,
	          position: 'relative'
	        }
	      },
	      stateParametros(){
	      	this.form.filtros=[];
	      	if(this.form.consulta=="Ingresos"){
	      		for (var i = 0; i < this.form.parametros.length; i++) {
	      			if(this.form.parametros[i]=='Ruta')
	      				this.form.filtros.push("Ruta")
	      			if(this.form.parametros[i]=='Origen')
	      				this.form.filtros.push("Origen")
	      			if(this.form.parametros[i]=='Destino')
	      				this.form.filtros.push("Destino")
	      		}
	      	}
	      	if(this.form.consulta=="Servicios"){
	      		for (var i = 0; i < this.form.parametros.length; i++) {
	      			if(this.form.parametros[i]=='Pasajeros')
	      				this.filtrosPjr=this.P;
	      		}
	      	}
	      }
	    },
		watch:{
			'form.consulta': function(){
				this.form.parametros=[];
				this.form.periodo="Actual";
				this.form.filtros=[];
				this.form.datosf=[];
				this.filtrosPjr=null;
				this.form.desde=null;
				this.form.hasta=null;
				this.form.filtrosP=[];
				this.cambiaOpciones();
			},
			'form.filtros': function(){
	      		this.form.datosf=[]
			}
		},
		methods:{
			aleatorio(){
				return Math.floor(Math.random() * (95 - 5 + 1)) + 5;
			},
			cambiaOpciones(){
				switch (this.form.consulta) {
					case "Personal":
						this.parametros=this.parametrosP;
						this.filtros=this.filtrosP;
						this.tipo="Del Personal";
						break;
					case "Ingresos":
						this.parametros=this.parametrosI;
						this.filtros=null;
						this.tipo="De Ingresos";
						break;
					case "Servicios":
						this.parametros=this.parametrosS;
						this.filtros=this.filtrosS;
						this.tipo="Del Servicio";
						break;
					default:
						// statements_def
						break;
				}
			},
			increaseHeight () {
		        this.height += 10
		      },
			generar(){
				var titulo="";
				var grafico="";
				var datos={};
				var label=[];
				var data=[];
				var stack=[];
				this.graficas=[];
				if(this.form.parametros.length){
				  	switch (this.form.consulta) {
				  		case "Personal":
				  			var barras=[];
				  			var datosbarra=[];
				  			var inferior=[];
				  			if(this.form.parametros.length>=1){
				  				if(this.form.parametros.length==1&&((this.form.datosf["Sucursal"]&&this.form.datosf["Sucursal"].length==1&&this.form.datosf["Cargo"]&&this.form.datosf["Cargo"].length==1)||(!this.form.datosf["Sucursal"]&&this.form.datosf["Cargo"]&&this.form.datosf["Cargo"].length==1))||(!this.form.datosf["Sucursal"]&&!this.form.datosf["Cargo"])){
					  				grafico="Torta";
					  				barras[0]="";
					  				titulo=titulo+this.form.parametros[0];
					  				if(this.form.parametros.length==1){
					  					if(!this.form.datosf["Sucursal"]&&!this.form.datosf["Cargo"]){
						  					inferior.push(this.form.parametros[0]);
						  				}else{
						  					if(this.form.datosf["Sucursal"]){
						  						if(this.form.datosf["Cargo"])
						  							inferior.push(this.form.parametros[0]+", Suc. "+this.form.datosf["Sucursal"][0]+" "+this.form.datosf["Cargo"][0]);
						  						inferior.push(this.form.parametros[0]+", Suc. "+this.form.datosf["Sucursal"][0]);
						  					}
						  					else{
						  						inferior.push(this.form.parametros[0]+" "+this.form.datosf["Cargo"][0]);
						  					}
						  				}
					  					inferior.push("otro");
					  					var auxAle=this.aleatorio();
						  				datosbarra=[auxAle,(100-auxAle)];
					  				}
					  				else{
					  					var auxT=0;
							  			for (var i = 0; i < this.form.parametros.length; i++) {
							  				var auxAle=((100/this.form.parametros.length)*this.aleatorio())/100;
						  					datosbarra.push(auxAle);
						  					auxT+=auxAle;
							  				if(!this.form.datosf["Sucursal"]&&!this.form.datosf["Cargo"]){
							  					inferior.push(this.form.parametros[i]);
							  				}else{
							  					if(this.form.datosf["Sucursal"]){
							  						if(this.form.datosf["Cargo"])
							  							inferior.push(this.form.parametros[i]+", Suc. "+this.form.datosf["Sucursal"][0]+" "+this.form.datosf["Cargo"][0]);
							  						inferior.push(this.form.parametros[i]+", Suc. "+this.form.datosf["Sucursal"][0]);
							  					}
							  					else{
							  						inferior.push(this.form.parametros[i]+" "+this.form.datosf["Cargo"][0]);
							  					}
							  				}
							  			}
							  			if(this.form.parametros.length==4)
							  				datosbarra[0]+=(100-auxT);
							  			else{
					  						inferior.push("otro");
						  					datosbarra.push((100-auxT));
							  			}
					  				}
				  				}
				  				else{
						  			grafico="Bar";
						  			inferior=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'];
						  			for (var i = 0; i < this.form.parametros.length; i++) {
						  				if(titulo=='')
						  					titulo=this.form.parametros[i];
						  				else
						  					titulo=titulo+", "+this.form.parametros[i];
					  					if(this.form.datosf["Sucursal"]){
					  						for (var j = 0; j < this.form.datosf["Sucursal"].length; j++) {
					  							if(this.form.datosf["Cargo"]){
					  								for (var k = 0; k < this.form.datosf["Cargo"].length; k++) {
					  									barras.push(this.form.parametros[i]+": Suc. "+this.form.datosf["Sucursal"][j]+", "+this.form.datosf["Cargo"][k]);
					  									datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
					  								}
					  							}else{
					  								barras.push(this.form.parametros[i]+": Suc. "+this.form.datosf["Sucursal"][j]);
					  								datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
					  							}
					  						}
					  					}
					  					else{
					  						if(this.form.datosf["Cargo"]){
				  								for (var k = 0; k < this.form.datosf["Cargo"].length; k++) {
					  									barras.push(this.form.parametros[i]+", "+this.form.datosf["Cargo"][k]);
						  								datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
				  								}
				  							}else{
				  								barras.push(this.form.parametros[i]);
						  						datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
				  							}
					  					}
					  				}
				  				}
								datos={labels:inferior,label:barras,data:datosbarra}
				  				this.graficas.push({
			  						"titulo":titulo.toUpperCase(),
			  						"grafica":grafico,
			  						"datos":datos
			  					});
				  			}
				  			break;
				  		case "Ingresos":
				  				var label=[];
				  				var data=[];
						  		var inferior=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'];
				  				label=[];
				  				data=[];
				  			for (var i = 0; i < this.form.parametros.length; i++) {
				  				for (var j = 0; j < this.form.filtros.length; j++) {
				  					if(this.form.datosf[this.form.filtros[j]]){
			  							for (var k = 0; k < this.form.datosf[this.form.filtros[j]].length; k++) {
			  								if(this.form.filtros[j]==this.form.parametros[i]){
				  								label.push(this.form.datosf[this.form.filtros[j]][k]);
				  								data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
			  								}
			  							}
		  							}
				  				}
				  			}
				  			titulo="Ingresos";
							grafico="Bar";
							datos={labels:inferior,label:label,data:data}
			  				this.graficas.push({"titulo":titulo.toUpperCase(),"grafica":grafico,"datos":datos});
				  			break;
				  		case "Servicios":
				  			var cont=0;
				  			var i=this.form.parametros[0]=='Vuelos' ? 0 : 1;
				  			if(this.form.parametros.length>1){ //vuelos y pasajeros
				  				for (var j = 0; j < this.form.filtros.length; j++) {
			  						if(this.form.datosf[this.form.filtros[j]]){
			  							for (var k = 0; k < this.form.datosf[this.form.filtros[j]].length; k++) {
			  								label.push(this.form.parametros[i]+" "+this.form.filtros[j]+" "+this.form.datosf[this.form.filtros[j]][k]);
											stack.push(cont);
											data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
											for (var p = 0; p < this.form.filtrosP.length; p++) {
						  						label.push(" Pasajeros "+this.form.filtros[j]+" "+this.form.datosf[this.form.filtros[j]][k]+" "+this.form.filtrosP[p]);
												stack.push(cont);
												data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
						  					}
											cont++;
			  							}
			  						}
			  					}
				  			}else{ //vuelo ó pasajero
				  				if(i==0){//es vuelo
				  					for (var j = 0; j < this.form.filtros.length; j++) {
				  						if(this.form.datosf[this.form.filtros[j]]){
				  							for (var k = 0; k < this.form.datosf[this.form.filtros[j]].length; k++) {
				  								label.push(this.form.parametros[i]+" "+this.form.filtros[j]+" "+this.form.datosf[this.form.filtros[j]]);
												data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
				  							}
				  						}
				  					}
				  				}
				  				else{//es pasajero
				  					i=0;
				  					for (var k = 0; k < this.form.filtrosP.length; k++) {
				  						label.push(this.form.parametros[i]+" "+this.form.filtrosP[k]);
										stack.push(cont);
										cont++;
										data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
				  					}
				  				}
				  			}


				  			titulo="Servicios";
				  			inferior=[ 'Abril', 'Mayo', 'Junio', 'Julio'];
				  			// label=['Vuelos origen 2','Vuelos destino 1','Vuelos ruta 2'];
				  			// stack=['Stack 0','Stack 1','Stack 2'];
				  			// data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
				  			// data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
							grafico="BarG";
							datos={labels:inferior,label:label,stack:stack,data:data}
			  				this.graficas.push({"titulo":titulo.toUpperCase(),"grafica":grafico,"datos":datos});
				  			break;
				  	}
				}
			}
		}
	}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style type="text/css">
	.multiselect__tag{
		font-size: 1.2rem;
	}
	label, legend {
		font-weight: 800;
	}
	span.custom__remove{
		margin-left: 10px;
	}
</style>