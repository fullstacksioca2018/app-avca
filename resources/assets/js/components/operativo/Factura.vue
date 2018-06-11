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
     
       <template slot="localizador" slot-scope="row"><div v-for="boleto in row.value">{{boleto}}</div></template>
       <template slot="boletos" slot-scope="row"><div v-for="cedula in row.value">{{cedula.documento}}</div></template>
   
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
        <b-input-group>
        <b-button size="sm" @click.stop="info(row.item,row.item, row.index, $event.target)" class="mr-1" variant="primary">
          Pagar
        </b-button>
        <b-button size="sm" @click.stop="cancelar(row.item,row.item, row.index, $event.target)" class="mr-1" variant="secundary">
          Cancelar 
        </b-button>
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
    <div v-if="modalInfo.content != ''">
     <b-form @submit.prevent="actualizar()"> 
         <!--  <pre>{{modalInfo.content}}</pre> -->
       
       <div class="row col-sm-12">
         <div class="col-sm-5">
         <div class="card-body">
          Vuelos:
      <div v-for="vuelo in modalInfo.content.vuelos">
       {{vuelo.n_vuelo }} || {{vuelo.segmentos[0].ruta.sigla}}
         </div>
       </div>
         </div>
          
       
      <div class="col-sm-5">
        <div class="card-body">
       Pasajeros:
      <div v-for="pasajero in modalInfo.content.boletos">
        {{pasajero.primerNombre}} {{pasajero.apellido}}
       </div>
        </div>
      </div>
      </div>
          <hr>
        
        <div class="row col-sm-12">
        
         <div class="input-group text-center">
         <strong> Total a Pagar:</strong> &nbsp   {{modalInfo.content.importe_facturado}}
         </div>
        </div>
          
         <hr>
    
         <div class="row"><p></p></div>
         <div class="row col-sm-10 offset-1">
           <div class="col-sm-5">
             <span class="help-block">Nombre</span>
               <div class="input-group">
            <b-form-input type="text" v-model="compra.nombre" class="form-control" autofocus required></b-form-input>            
          </div> <!-- input-group.// -->
           </div>
        
          <div class="col-sm-5">
             <span class="help-block">N° Confirmacion</span>
               <div class="input-group">
            <b-form-input type="number" class="form-control" autocomplete="off" required v-model="compra.referencia"></b-form-input>
          </div> <!-- input-group.// -->
           </div>
        
         </div> <!-- fin row -->

         <div class="row"><p></p></div>
         <div class="row col-sm-10 offset-1">
           <div class="col-sm-5">
             <span class="help-block">Tipo de Pago</span>
               <div class="input-group">
                <b-form-select class="form-control" name="tipo_pago" :options="tipo" required v-on:change="cambiarestado()" v-model="compra.tipo"></b-form-select>
          </div> <!-- input-group.// -->
           </div>
        
          <div class="col-sm-5">
             <span class="help-block">Tarjeta</span>
               <div class="input-group">
        
                <b-form-select class="form-control" required :options="tarjetas" v-model="compra.tarjeta"></b-form-select>
          </div> <!-- input-group.// -->
           </div>
        
         </div> <!-- fin row -->  
         <div class="row"><p></p></div>  
      <div class="text-center">
        <b-button type="submit" variant="primary" >Pagar Factura</b-button>
      </div>
     </b-form>
     </div>
   <!--  </div> -->
     
    </b-modal> 

  </b-container>
</template>

<script>

import axios  from 'axios';
import {EventBus} from './event-bus.js'


export default {
  components: {
  },
  created: function(){
    EventBus.$on('actualizartabla',(event) =>{
      this.Cargadatos(this);
    });
    this.Cargadatos(this)

  },
  data () {
    return {
      items: null,
      data: null,
      compra: {id:'', referencia:'', tipo:'', tarjeta:''},
      fields: [
      
        { key: 'numero_factura',    label: '#',  sortable: true },
        { key: 'localizador',   label: 'Localizador(es)', sortable: true },
        { key: 'boletos', label: 'Cedula(s) ', sortable: true },
        { key: 'actions',   label: '  ', 'class' : 'text-center' }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      pageOptions: [ 5, 10, 15 ],
      filter: null,
      modalInfo: { title: '', content: '' },
      tipo: ['Débito', 'Crédito'],
      tarjetas: ['Maestro']
    }
  },
  computed: {

  },
  methods: {
    info (item, index, button) {
      this.modalInfo.content = item;
      this.modalInfo.title = "Factura #"+item.numero_factura;
      this.compra.tipo="Débito";
      this.compra.tarjeta="Maestro";
      this.$root.$emit('bv::show::modal', 'modalInfo', button)
    },

    cambiarestado(){
       if(this.compra.tipo=="Débito")
      {
        this.tarjetas=['Visa','Mastercard','American Express'];
        this.compra.tarjeta='Visa';
      }
      else{
        this.tarjetas=['Maestro'];
        this.compra.tarjeta='Maestro';
        
      }
    },  
    cancelar(item, index, button){
       this.$dialog.confirm('Esta opcion no puede ser revertida')
       .then(function(){
          axios({
                method: 'post',
                url: '/factura/cancelar',
                data: item
                
               }).then((response)=>{
                console.log(response.data);
                Vue.toasted.show(response.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                });
                EventBus.$emit('actualizartabla',true);
                  this.$root.$emit('bv::hide::modal', 'agregar', '#app');
               }).catch((err) =>{

               });
       })
       .catch(function(){
          console.log('Cancelar esta Operacion')
       })
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
      axios.get("/factura/facturas").then(function(response){
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
       var localizador=[];
       for(var j=0; j<this.data[i].boletos.length;j++)
        {
          localizador.push(this.data[i].boletos[j].localizador);
        }
        this.items.push({
          id: this.data[i].id,
          numero_factura:this.data[i].numero_factura,
          importe_facturado:this.data[i].importe_facturado,
          numero_control:this.data[i].numero_control,
          adultos_cant:this.data[i].adultos_cant,
          ninos_cant:this.data[i].ninos_cant,
          NinosBrazos_cant:this.data[i].NinosBrazos_cant,
          boletos:this.data[i].boletos,
          vuelos:this.data[i].vuelos,
          localizador:localizador
        });
      }
     
    },
    actualizar(){
               this.compra.id=this.modalInfo.content.id;
               axios({
                method: 'post',
                url: '/factura/pagar',
                data: this.compra
               }).then((response)=>{
                console.log(response.data);
                Vue.toasted.show(response.data, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                });
                this.compra.id='';
                this.compra.referencia='';
                this.compra.tipo='';
                this.compra.tarjeta='';
                EventBus.$emit('actualizartabla',true);
                  this.$root.$emit('bv::hide::modal', 'modalInfo', '#app');
               }).catch((err) =>{
                 console.log(err);
                Vue.toasted.show("Error al cargar los datos"+err, {
                    theme: "primary", 
	                position: "bottom-right",
	                duration : 2000
                });
               });
           }
  }
}
</script>

<!-- table-complete-1.vue -->