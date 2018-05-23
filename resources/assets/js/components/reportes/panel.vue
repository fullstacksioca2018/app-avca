<template>
	<div class="container">
		
		<div class="card">
	    	<div class="card-block">
				<div id="panel">
				    <div class="container" style="width: 95%; padding-top: 40px;">
						<!-- Tipo de Consulta -->
						<b-form-group>
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
					    	<div class="col-3" v-if="form.consulta!='Personal'">
							     <b-form-group label="Fecha">
							      <b-form-radio-group v-model="form.periodo"
							                          :options="optionsP"
							                          stacked
							                          name="radiosStacked">
							      </b-form-radio-group>
							    </b-form-group>
					    	</div>
					    	<div class="col-3" v-else>
					    		<b-form-group label="Fecha">
							      <b-form-radio-group v-model="form.periodo"
							                          :options="optionsPP"
							                          stacked
							                          name="radiosStacked">
							      </b-form-radio-group>
							    </b-form-group>
					    	</div>
						    <!-- Filtros -->
						    <div class="col-6">
						    	<b-form-group>
							      <b-form-radio-group id="btnradios1"
							                          buttons
							                          v-model="form.tipo"
							                          :options="tiposC"
							                          name="radiosBtnDefault" />
							    </b-form-group>
							    <div v-if="form.tipo=='Busqueda'" id="Busqueda" class="row marginCero">
									<legend class="typo__label">Condición: [{{ textC }}]</legend>
									  <multiselect v-model="form.busqueda" :options="busqueda" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar" class="col-5 sinpadding">
									    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
									  </multiselect>
									  <div v-if="form.busqueda=='Mayor que'||form.busqueda=='Menor que'" class="col-4 sinpadding">
										  <multiselect v-model="form.busquedaMonto" :options="busquedaMonto" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" :preselect-first="false" selectLabel="Seleccionar" placeholder="Parametro">
										    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										  </multiselect>
									  </div>
									  <multiselect v-model="form.busquedaRow" :options="busquedaRow" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" :preselect-first="false" selectLabel="Seleccionar" class="col sinpadding" placeholder="Resultados">
									    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
									  </multiselect>
								</div>
						    	<div v-if="filtros!=null">
						    		 <div>
										  <legend class="typo__label">Otros Filtros</legend>
										  <multiselect v-model="form.filtros" :options="filtros" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar">
										    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										  </multiselect>
									</div>
						    	</div>
							    <div v-if="form.filtros!=null">
							    	<!-- <div class="form-row"> -->
							    	<div v-for="filtroA in form.filtros">
								    	<b-form-group :label="filtroA">
								    		<multiselect v-if="filtroA=='Cargo'" v-model="form.datosf[filtroA]" :options="opciones.Cargo" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
										    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										  </multiselect>
											<multiselect v-if="filtroA=='Sucursal'" v-model="form.datosf[filtroA]" :options="opciones.Sucursal" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Sucursal" :preselect-first="false" selectLabel="Seleccionar">
										    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
											</multiselect>
											<multiselect v-if="filtroA=='Origen'" v-model="form.datosf[filtroA]" :options="opciones.Origen" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Sucursal Origen" :preselect-first="false" selectLabel="Seleccionar">
										    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
											</multiselect>
											<multiselect v-if="filtroA=='Destino'" v-model="form.datosf[filtroA]" :options="opciones.Destino" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Sucursal Destino" :preselect-first="false" selectLabel="Seleccionar">
										    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
											</multiselect>
											<multiselect v-if="filtroA=='Ruta'" v-model="form.datosf[filtroA]" :options="opciones.Ruta" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Ruta" :preselect-first="false" selectLabel="Seleccionar">
										    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
											</multiselect>
										</b-form-group>
							    	</div>
							    <!-- </div> -->
							    </div>
						    	<div v-if="filtrosPjr!=null">
							    	<div>
										  <legend class="typo__label">Filtros Pasajeros</legend>
										  <multiselect v-model="form.filtrosP" :options="filtrosPjr" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar">
										    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										  </multiselect>
									</div>
						    	</div>

						    	<div v-if="filtrosVls!=null">
							    	<div>
										  <legend class="typo__label">Filtros Vuelos</legend>
										  <multiselect v-model="form.filtrosV" :options="filtrosVls" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione filtro" :preselect-first="false" selectLabel="Seleccionar">
										    <template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										  </multiselect>
									</div>
						    	</div>
							</div>
					    </div>
					    <div class="form-row" v-if="form.periodo=='Temporada'">
					    	<div class="col-3" >
					    		 <legend>Temporada</legend>
					    		 <multiselect v-model="form.temporadas" :options="opcionesT" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Temporada" :preselect-first="false" selectLabel="Seleccionar">
							    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
								</multiselect>
							    <!-- <b-form-select multiple :select-size="4" v-model="form.temporadas" :options="opcionesT" class="mb-3">
						    	</b-form-select> -->
					    	</div>
					    	<div class="col-2" >
					    		 <legend>Año</legend>
					    		 <multiselect v-model="form.year" :options="year" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Seleccione Cargos" :preselect-first="false" selectLabel="Seleccionar">
							    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
								</multiselect>
							    <!-- <b-form-select multiple :select-size="4" v-model="form.year" :options="year" class="mb-3"> -->
						    	</b-form-select>
					    	</div>
						</div>
					    	<div class="row" v-if="form.periodo=='Personalizado'&&form.consulta!='Personal'">
					    		<div class="col-md-3">
					              <label for="fecha_ingreso">Desde</label>
					              <div class="input-group">
					              	<b-form-input v-model="form.desde" type="date">
								      </b-form-input>
					                <div class="input-group-append">
					                  <span class="input-group-text">
					                    <i class="fa fa-calendar"></i>
					                  </span>
					                </div>
					              </div>
					            </div>
					            <div class="col-md-3">
					              <label for="fecha_ingreso">Hasta</label>
					              <div class="input-group">
					                <b-form-input v-model="form.hasta" type="date">
								      </b-form-input>
					                <div class="input-group-append">
					                  <span class="input-group-text">
					                    <i class="fa fa-calendar"></i>
					                  </span>
					                </div>
					              </div>
					            </div>
					        </div>
					        <div v-if="form.periodo=='Intervalo'&&form.consulta=='Personal'">
					        	<br>
					            <label for="fecha_ingreso">Fecha Personalizada</label>
					        	<br>
					        	<div class="row">
						        	<div class="col-md-2">
						              <label for="fecha_ingreso">Desde</label>
						              <div class="input-group">
						              	<multiselect v-model="form.mesD" :options="mes" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Mes" :preselect-first="true" selectLabel="Seleccionar">
									    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										</multiselect>
						              </div>
						            </div>
						            <div class="col-md-2" id="flex-Perso">
						              <label for="fecha_ingreso"></label>
						              <div class="input-group">
						              	<multiselect v-model="form.yearD" :options="year" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Año" :preselect-first="true" selectLabel="Seleccionar">
									    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										</multiselect>
						                <div class="input-group-append">
						                  <span class="input-group-text">
						                    <i class="fa fa-calendar"></i>
						                  </span>
						                </div>
						              </div>
						            </div>
					        	</div>
					        	<div class="row">
						            <div class="col-md-2">
						              <label for="fecha_ingreso">Hasta</label>
						              <div class="input-group">
						              	<multiselect v-model="form.mesH" :options="mes" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Mes" :preselect-first="true" selectLabel="Seleccionar">
									    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										</multiselect>
						              </div>
						            </div>
						            <div class="col-md-2" id="flex-Perso">
						              <label for="fecha_ingreso"></label>
						              <div class="input-group">
						              	<multiselect v-model="form.yearH" :options="year" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Año" :preselect-first="true" selectLabel="Seleccionar">
									    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										</multiselect>
						                <div class="input-group-append">
						                  <span class="input-group-text">
						                    <i class="fa fa-calendar"></i>
						                  </span>
						                </div>
						              </div>
						            </div>
					        	</div>
					        <!-- </div> -->
					    </div><br>
					    <div v-if="form.periodo=='Personalizado'&&form.consulta=='Personal'">
					        	<br>
					            <label for="fecha_ingreso">Fecha Personalizada</label>
					        	<br>
					        	<div class="row">
						        	<div class="col-md-2">
						              <label for="fecha_ingreso">Mes\Año</label>
						              <div class="input-group">
						              	<multiselect v-model="form.mesD" :options="mes" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Mes" :preselect-first="true" selectLabel="Seleccionar">
									    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										</multiselect>
						              </div>
						            </div>
						            <div class="col-md-2" id="flex-Perso">
						              <label for="fecha_ingreso"></label>
						              <div class="input-group">
						              	<multiselect v-model="form.yearD" :options="year" :multiple="false" :close-on-select="true" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="Año" :preselect-first="true" selectLabel="Seleccionar">
									    	<template slot="tag" slot-scope="props"><span class="custom__tag multiselect__tag"><span>{{ props.option }}</span><span class="custom__remove" @click="props.remove(props.option)"><i class="fa fa-times-circle"></i></span></span></template>
										</multiselect>
						                <div class="input-group-append">
						                  <span class="input-group-text">
						                    <i class="fa fa-calendar"></i>
						                  </span>
						                </div>
						              </div>
						            </div>
					        	</div>
					    </div><br>
						<div class="row">
				          <div class="col-12">
				            <div class="form-group">
				              <button type="submit" class="btn btn-success" @click="generar2()">
				                <i class="fa fa-check"></i>Generar
				              </button>
				            </div>
				          </div>
				        </div>
				    	
				    </div>
			</div>
		</div>
		<div class="card" v-if="!loading">
	    	<div class="card-block">
				<div v-show="graficas.length>=1">
		        	<Resultados :graficas="graficas" :tipo="form.consulta"></Resultados>
		        </div>
	    	</div>
	    </div>
	    <div class="card" v-else>
	    	<scale-loader :loading="loading" :color="color" :height="height" :width="width"></scale-loader>
	    </div>
	</div>
</div>
</template>
<script src="../fontawesome-all.min.js"></script>

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
				dataPoints: null,
        		height: 20,
				datos:[23,21,12,43],
				textC:null,
				form:{
					consulta:"Personal",
					parametros:[],
					parametrosRest:[],
					periodo:"Actual",
					filtros:[],
					filtrosP:[],
					datosf:[],
					desde:null,
					hasta:null,
					mesD:null,
					mesH:null,
					yearD:null,
					yearH:null,
					temporadas:[],
					year:['2017'],
					tipo:"Consulta",
					busqueda:"Más alto",
					busquedaRow:"1",
					busquedaMonto:"2000",
					filtrosV:null,
					cargosF:null,
					sucursalesF:null,
					origenesF:null,
					destinosF:null,
					rutasF:null
				},
				tiposC:["Consulta","Busqueda"],
				filtrosPjr:null,
				P:[
					'Bebe','Niños','Adolecente','Adulto','Discapacitado'
				],
				V:[
					'Abiertos','Ejecutados','Demorados','Cancelados'
				],
				filtrosV:null,
				year:["2016","2017","2018"
				],
				mes:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio"
				,"Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
				opcionesT:[ 'Decembrina','Semana Santa','Carnavales'
				],
				graficas:[],
				tipos:[	],
				parametros:[ 'Asistencias','Inasistencias','Licencias'/*,'Vacaciones'*/
				],
				parametrosP:['Asistencias','Inasistencias','Licencias'/*,'Vacaciones'*/
				],
				parametrosI:['Ruta','Destino','Origen'
				],
				parametrosS:['Vuelos','Pasajeros'
				],
				optionsPP:['Mes anterior','Personalizado','Intervalo'
				],
				optionsP:['Actual','Semana anterior','Mes anterior','Temporada','Personalizado'
				],
				filtros:[
					"Cargo","Sucursal"
				],
				busqueda:["Más alto","Más bajo","Mayor que","Menor que"],
    			busquedaRow:["1","2","3","4","5"],
				busquedaMonto:["1000","1500","2000","2500","3000"]
				,
				filtrosP:['Cargo','Sucursal'
				],
				filtrosVls:null,
				filtrosS:['Origen','Destino','Ruta'
				],
				tipo: "Del Personal",
				opciones:{
					Cargo:[],
					Sucursal:[],
					Origen:[],
					Destino:[],
					Ruta:['Ruta 1','Ruta 2', 'Ruta 3'
					],
				},
				auxC:false,
				loading:false,
				color:"#4DBFEE",
				size:"5px",
				height:"50px",
				width:"8px",
			}
		},
		computed: {
		    datosGDashbord: function() {
		        return this.GraficaP
		      },
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
	      		if(this.form.parametrosRest.length==0)
	      			this.form.parametrosRest=this.form.parametros;
	      		for (var i = 0; i < this.form.parametros.length; i++) {
	      			if(this.form.parametros[i]=='Pasajeros')
	      				this.filtrosPjr=this.P;
	      			if(this.form.parametros[i]=='Vuelos')
	      				this.filtrosVls=this.V;
	      		}
	      		if(this.form.parametrosRest.length>this.form.parametros.length){
	      			if(this.form.parametros.length!=0){
	      				if(this.form.parametros[0]=='Pasajeros')
	      					this.filtrosVls=null;
	      				else
	      					this.filtrosPjr=null;
	      			}
	      			else{
      					this.filtrosVls=null;
      					this.filtrosPjr=null;
	      			}
	      		}
	      		this.form.parametrosRest=this.form.parametros;
	      	}
	      }
	    },
		watch:{
			'datosGDashbord': function(){
				this.Dashboard();
			},
			'form.consulta': function(){

			},
			'form.consulta': function(){
				if(!this.auxC){
					this.form.parametros=[];
					this.form.periodo="Actual";
					this.form.desde=null;
					this.form.hasta=null;
				}
				else
					this.auxC=false
				if(this.form.consulta=='Personal')
					this.form.periodo="Mes anterior";
				this.form.filtros=[];
				this.form.datosf=[];
				this.filtrosPjr=null;
				this.filtrosVls=null;
				this.form.filtrosP=[];
				this.form.tipo="Consulta";
				this.form.busqueda="Más alto";
				this.form.busquedaRow="1";
				this.form.busquedaMonto="2000";
				this.cambiaOpciones();
			},
			'form.filtros': function(){
	      		this.StringConsulta()
			},
			'form.busqueda': function(){
	      		this.StringConsulta()
			},
			'form.busquedaRow': function(){
	      		this.StringConsulta()
			},
			'form.busquedaMonto': function(){
	      		this.StringConsulta()
			}
		},
		created: function(){
			this.tipoUser();
            this.CargarSucursales();
            this.CargarCargos();
            if(this.form.consulta=='Personal')
				this.form.periodo="Mes anterior";
        },
        mounted () {
            this.Dashboard();
		 },
		methods:{
			cargarFiltros(){
				if(this.form.datosf["Cargo"]){
					this.form.cargosF=this.form.datosf['Cargo'];
				}
				if(this.form.datosf["Sucursal"]){
					this.form.sucursalesF=this.form.datosf['Sucursal'];
				}
				if(this.form.datosf["Origen"]){
					this.form.origenesF=this.form.datosf['Origen'];
				}
				if(this.form.datosf["Destino"]){
					this.form.destinosF=this.form.datosf['Destino'];
				}
				if(this.form.datosf["Ruta"]){
					this.form.rutasF=this.form.datosf['Ruta'];
				}
			},
			tipoUser(){
				if(this.user){
					switch (this.user) {
						case "Gerente General":
							this.tipos=['Personal','Ingresos','Servicios'],
							this.form.consulta='Personal'
							break;
						case "Gerente RRHH":
							this.tipos=['Personal'],
							this.form.consulta='Personal'
							break;
						case "Gerente Sucursales":
							this.tipos=['Ingresos','Servicios'],
							this.form.consulta='Ingresos'
							break;
					}
				}
			},
			Dashboard(){
				if(this.datosGDashbord!=null){
					this.auxC=true;
			  		this.graficas=[];
			  		this.graficas.push(this.datosGDashbord[0]);
			  		if(this.consultaProp.consulta)
			  			this.form.consulta=this.consultaProp.consulta
			  		if(this.consultaProp.parametros){
			  			this.form.parametros=this.consultaProp.parametros
			  			this.form.parametrosRest=this.consultaProp.parametros
			  		}
			  		if(this.consultaProp.filtrosV)
			  			this.form.filtrosV=this.consultaProp.filtrosV
			  		if(this.consultaProp.periodo)
			  			this.form.periodo=this.consultaProp.periodo
			  		if(this.consultaProp.desde)
			  			this.form.desde=this.consultaProp.desde
			  		if(this.consultaProp.hasta)
			  			this.form.hasta=this.consultaProp.hasta
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
			CargarCargos(){
				axios({
                    method: 'get',
                    url: '/listar-cargos'       
                }).then((response) =>{
                    this.formatocargos(response);
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
			formatosucursal(data){
				 //Anadir datos
                for (var i= 0; i < data.data.length; i++){
                    this.opciones.Sucursal.push(data.data[i].nombre);
                    this.opciones.Origen.push(data.data[i].nombre);
                    this.opciones.Destino.push(data.data[i].nombre);
                }
			},
			StringConsulta(){
				this.textC=null;
				if(this.form.busqueda=='Más alto'||this.form.busqueda=='Más bajo'){
					if(this.form.busquedaRow=='1'){
						this.textC="El "+this.form.busqueda;
					}
					else{
						this.textC="Los "+this.form.busquedaRow+" "+this.form.busqueda;
					}
				}
				else{
					if(this.form.busquedaRow=='1'){
						this.textC="El "+this.form.busqueda+" "+this.form.busquedaMonto;
					}
					else{
						if(this.form.busqueda=='Mayor que')
							this.textC="Los "+this.form.busquedaRow+" Mayores que "+this.form.busquedaMonto;
						else
							this.textC="Los "+this.form.busquedaRow+" Menores que "+this.form.busquedaMonto;
					}
				}

			},
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
		     validarGG(){
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
		     	return true;
		     },
			generar2(){
               // console.log(this.form.datosf)
               this.loading=true;
               this.cargarFiltros();
               this.graficas=[];
               if(this.validarGG()){
				axios.post('/reportes/api/reporte',this.form).then((response) =>{
					console.log(response.data);
					this.graficas.push({
  						"titulo":response.data.titulo.toUpperCase(),
  						"grafica":response.data.grafico,
  						"datos":response.data.datos
  					});
               		this.loading=false;
					Vue.toasted.show('Reporte Generado', {
                        theme: "primary", 
	                    position: "bottom-right",  
	                    duration : 2000
                    });
				}).catch(function (error) {
		        	Vue.toasted.show('Ha ocurrido un error', {
                        theme: "primary", 
	                    position: "bottom-right",  
	                    duration : 2000
                    });
		        });
               }
               else{
               		this.loading=false;
               }
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
						  			inferior=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
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
					  									datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
					  								}
					  							}else{
					  								barras.push(this.form.parametros[i]+": Suc. "+this.form.datosf["Sucursal"][j]);
					  								datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
					  							}
					  						}
					  					}
					  					else{
					  						if(this.form.datosf["Cargo"]){
				  								for (var k = 0; k < this.form.datosf["Cargo"].length; k++) {
					  									barras.push(this.form.parametros[i]+", "+this.form.datosf["Cargo"][k]);
						  								datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
				  								}
				  							}else{
				  								barras.push(this.form.parametros[i]);
						  						datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
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
						  		var inferior=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
				  				label=[];
				  				data=[];
				  			for (var i = 0; i < this.form.parametros.length; i++) {
				  				for (var j = 0; j < this.form.filtros.length; j++) {
				  					if(this.form.datosf[this.form.filtros[j]]){
			  							for (var k = 0; k < this.form.datosf[this.form.filtros[j]].length; k++) {
			  								if(this.form.filtros[j]==this.form.parametros[i]){
				  								label.push(this.form.datosf[this.form.filtros[j]][k]);
				  								data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
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
				  			inferior=[ 'Abril', 'Mayo'];
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
	#flex-Perso .input-group{
		flex-wrap: inherit;
	}
</style>