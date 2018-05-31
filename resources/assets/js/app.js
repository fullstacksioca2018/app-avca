
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

 window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('vacante-form', require('./components/backend/vacante/VacanteForm'));
Vue.component('aspirante-form', require('./components/frontend/AspiranteForm'));
Vue.component('vacante-filter', require('./components/backend/vacante/VacanteFilter'));
Vue.component('aspirante-table', require('./components/backend/aspirante/AspiranteTable'));
Vue.component('aspirante-status', require('./components/backend/aspirante/AspiranteStatus'));
Vue.component('contratacion', require('./components/backend/rrhh/contratacion/Contratacion'));
//RUTAS
Vue.component('Rutas', require('./components/operativo/AdministracionRutas.vue'));
//VUELOS
Vue.component('Vuelos', require('./components/operativo/PlanificarVuelos.vue'));
Vue.component('VuelosAbiertos', require('./components/operativo/VuelosAbiertos.vue'));
Vue.component('VuelosCerrados', require('./components/operativo/VuelosCerrados.vue'));
Vue.component('VuelosRetrasados', require('./components/operativo/VuelosRetrasados.vue'));
Vue.component('VuelosEjecutados', require('./components/operativo/VuelosEjecutados.vue'));
Vue.component('VuelosCancelados', require('./components/operativo/VuelosCancelados.vue'));
//TRIPULACION
Vue.component('CargarPilotos', require('./components/operativo/CargarPilotos.vue'));
Vue.component('CargarCopilotos', require('./components/operativo/CargarCopilotos.vue'));
Vue.component('CargarJefeCabina', require('./components/operativo/CargarJefeCabina.vue'));
Vue.component('CargarSobrecargo', require('./components/operativo/CargarSobrecargo.vue'));
Vue.component('CargarAeronave', require('./components/operativo/CargarAeronave.vue'));
// AERONAVES
Vue.component('Aeronaves',require('./components/operativo/AdministracionAeronaves.vue'));

// Empleado
Vue.component('ficha-empleado', require('./components/backend/rrhh/empleado/FichaEmpleado'));

// Nomina del empleado
Vue.component('generar-nomina', require('./components/backend/rrhh/nomina/GenerarNomina'));
Vue.component('consultar-nomina', require('./components/backend/rrhh/nomina/ConsultarNomina'));

// Sucursal
Vue.component('listado-sucursales', require('./components/backend/rrhh/sucursal/ListadoSucursal'));

// Parametros de nomina
Vue.component('parametros-nomina', require('./components/backend/rrhh/parametros/ParametrosNomina'));

// Asistencia del empleado
Vue.component('empleado', require('./components/backend/rrhh/asistencia/Empleado'));

Vue.component('panel', require('./components/reportes/panel.vue'));
Vue.component('dashboard', require('./components/reportes/Dashboard.vue'));
Vue.component('breadcrumbpersonal', require('./components/reportes/breadcrumbPersonal.vue'));

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

// Loader
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.min.css';
Vue.use(Loading);

const app = new Vue({
    el: '#app'
});
