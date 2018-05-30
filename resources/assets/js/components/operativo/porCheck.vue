<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Filtro" class="mb-0">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Escriba para buscar" />
            <b-input-group-append>
              <b-btn :disabled="!filter" @click="filter = ''">Limpiar</b-btn>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
      <p></p>
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Por Página" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
             @filtered="onFiltered"
    >
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
          <div v-if="row.item.estatus != 'Chequeado'">
          <b-button size="sm" class="btn btn-warning btn-sm" @click.stop="info(row.item, row.index, $event.target)" variant="success">
           Check-In
          </b-button>
          </div>
          <div v-else>
          <b-button size="sm" disabled="disabled" variant="primary">
            Chequeado
          </b-button>
        </div>
        </b-input-group>
      </template>
      <template slot="row-details" slot-scope="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
          </ul>
        </b-card>
      </template>
    </b-table>
    <b-col class="col-md-12 ">
      <b-pagination  align="center" :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
    </b-col>
   
    <!-- Modal Actualizar -->
    <b-modal ref="myModalRef" id="modalInfo" @hide="resetModal" :title="modalInfo.title"  hide-footer>  
     <!-- <pre>El modalinfo tiene {{modalInfo.content}}</pre> -->
     <div v-if="modalInfo.content != ''">
    <b-form @submit.prevent="actualizar()">
         
       <div class="row">
          <div class="form-group col-sm-1 "></div>
          <div class="col-sm-5">
            <span>Vuelo: {{ modalInfo.content.n_vuelo }}</span>
          </div>
          
         <div class="col-sm-5">
          <span> Pasajero: {{ modalInfo.content.pasajero }} </span>
          </div>
           <div class="form-group col-sm-1 "></div>
        </div>
        <!--  fin row de info de vuelo y pasajero  -->
      <div class="row"><p></p></div><!--  espacio -->
      
      <div class="row text-center">
        <label for="equipaje">Cantidad de Equipaje: </label>
        <div class="col-sm-4">
            <b-form-input id="equipaje"
                          type="number"
                          required
                          v-model="form.equipaje">
            </b-form-input>
          </div>
      </div>
      <div class="row"><p></p></div><!--  espacio -->
      <div class="row text-center">
       <label for="peso">Inserte  El peso total:        </label>
        <div class="col-sm-4">
           <b-input-group append="kgrs">
            <b-form-input id="peso"
                          type="number"
                          required
                          v-model="form.peso">
            </b-form-input>
           </b-input-group>
          </div>
      </div>
      <div class="row"><p></p></div><!--  espacio -->
      <div class="row text-center">
         <label for="sobrepeso" >Tarifa a pagar por SobrePeso:   </label>
          <div class="col-sm-4">
          <b-input-group append="BsS">
            <b-form-input id="sobrepeso"
                          type="number"
                          required
                          v-model="form.sobrepeso"
                          disable>
            </b-form-input>
          </b-input-group>
          </div>
     
    </div>
   <div class="row"><p></p><p></p></div><!--  espacio -->
   <div id='search-results' class="col-sm-6">
         <label for="asiento" >Seleccione el Asiento:   </label>
         <multiselect v-model="form.puesto" :options="puestos" selectLabel="Seleccionar" deselectLabel="Eliminar" selectedLabel="Seleccionado" placeholder="Seleccione el Puesto" label="asiento" track-by="asiento"></multiselect>                 
         <!-- <multiselect v-model="value" :options="options" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Pick a value"></multiselect> -->

    </div> 
    <div class="row"><p></p><p></p><pre>Su puesto {{ form.puesto }} !! </pre></div><!--  espacio -->
      <div class="text-center">
        <b-button type="submit" variant="primary" >Actualizar</b-button>
      </div>
      
    </b-form>
    </div>
     
    </b-modal>

  </b-container>
</template>

<script>

import axios  from 'axios';
import multiselect from 'vue-multiselect'
import {EventBus} from './event-bus.js'

export default {
  created: function(){
    EventBus.$on('actualizartabla',(event) =>{
      this.Cargadatos(this);
    });
    this.Cargadatos(this)

  },
   components: {
            multiselect
        },
   data () {
    return {
      items: null,
      data: null,
      fields: [
      
        { key: 'n_vuelo',    label: 'Vuelo',  sortable: true },
        { key: 'cedula', label: 'Cedula ', sortable: true},
        { key: 'pasajero', label: 'Nombre Pasajero ', sortable: true},
        { key: 'localizador',   label: 'Localizador de Boleto', sortable: true },
        { key: 'actions',   label: ' - ', 'class' : 'text-center' }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      filter: null,
      modalInfo: { title: '', content: '' },
      form: {equipaje: '', peso:'', sobrepeso:'', puesto:''},
       puestos: [
        "V-1",
        "V-2",
        "V-3"
        /* {puesto: "V-1"}, 
        {puesto: "P-2"} */
        /* {P3:"P-3"}, 
        {V4:"V-4"}, 
        {V5:"V-5"}, 
        {P6:"P-6"}, 
        {P7:"P-7"}, 
        {V8:"V-8"}, 
        {V9:"V-9"}, 
        {P10:"P-10"}, 
        {P11:"P-11"}, 
        {V12:"V-12"}, 
        {V13:"V-13"}, 
        {P14:"P-14"}, 
        {P15:"P-15"}, 
        {V16:"V-16"}, 
        {V17:"V-17"}, 
        {P18:"P-18"}, 
        {P19:"P-19"}, 
        {V20:"V-20"}, 
        {V21:"V-21"}, 
        {P22:"P-22"}, 
        {P23:"P-23"}, 
        {V24:"V-24"}, 
        {V25:"V-25"}, 
        {P26:"P-26"}, 
        {P27:"P-27"}, 
        {V28:"V-28"},         
        {V29:"V-29"}, 
        {P30:"P-30"},              
        {P31:"P-31"},              
        {V32:"V-32"},              
        {V33:"V-33"},              
        {P34:"P-34"},              
        {P35:"P-35"},              
        {V36:"V-36"},              
        {V37:"V-37"},              
        {P38:"P-38"},              
        {P39:"P-39"},              
        {V40:"V-40"},              
        {V41:"V-41"},              
        {P42:"P-42"},              
        {P43:"P-43"},              
        {V44:"V-44"},              
        {V45:"V-45"},              
        {P46:"P-46"},             
        {P47:"P-47"},              
        {V48:"V-48"},              
        {V49:"V-49"},              
        {P50:"P-50"},              
        {P51:"P-51"},              
        {V52:"V-52"},              
        {V53:"V-53"},              
        {P54:"P-54"},                             
        {P55:"P-55"}, 
        {V56:"V-56"}, 
        {V57:"V-57"}, 
        {P58:"P-58"}, 
        {P59:"P-59"}, 
        {V60:"V-60"}, 
        {V61:"V-61"}, 
        {P62:"P-62"}, 
        {P63:"P-63"}, 
        {V64:"V-64"} */
      ] 
    }
  },
  methods: {
      info (item, index, button) {
      this.modalInfo.content = item; 
       this.modalInfo.title = "Titulo aqui se va a chequear";     
      this.$root.$emit('bv::show::modal', 'modalInfo', button)
    },
   
    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
    Cargadatos(ctx){
      axios.get("/check/check").then(function(response){
        // console.log(response.data);
        ctx.data = response.data;
        ctx.formatodatos();
        ctx.totalRows=ctx.items.length;
      }).catch((err)=>{
        console.log("err");
        console.log(err);
      });
    },
    formatodatos(){
      this.items = [];
      for (var i= 0; i < this.data.length; i++){
        this.items.push({
          id: this.data[i].id,
          n_vuelo: this.data[i].codvuelos,
          pasajero:this.data[i].pasajero,
          nombreCompleto:this.data[i].nombre_pasajero,
          cedula:this.data[i].documento,
          origen:{
             nombre:this.data[i].origen,
             sigla:this.data[i].sigla_destino,
             aeropuerto:this.data[i].aeropuerto_origen
            },
          destino:{
             nombre:this.data[i].destino,
             sigla:this.data[i].sigla_destino,
             aeropuerto:this.data[i].aeropuerto_destino
            },
          estatus:this.data[i].estatus,
          localizador:this.data[i].localizador
        });
      }
     
    },
    chekear(row){
     this.$dialog.confirm('Esta opcion no puede ser revertida')
	    .then(function () {
              axios({
                  method: 'post',
                  url: '/check/check/chekear',
                  data: {
                    id: row.item.id,               
                  }
                }).then((response)=>{
                
                Vue.toasted.show(response.data, {
                  theme: "primary", 
                  position: "bottom-right",
                    duration : 2000
                });
                 EventBus.$emit('actualizartabla',true);
               // this.Cargadatos(this);

                }).catch((err)=>{
                  Vue.toasted.show("Boleto Check-In incorrecto"+err, {
                    theme: "primary",  
                  position: "bottom-right",
                    duration : 2000
                });
                });
                //fin axios
        })
	      .catch(function () {
		    console.log('Cancelar esta Operacion')
	       });
    } 
  }
} 
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"> </style>


