
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


Vue.component('panel', require('./components/reportes/panel.vue'));

const app = new Vue({
    el: '#app'
});
