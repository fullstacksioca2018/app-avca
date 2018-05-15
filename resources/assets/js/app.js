
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
Vue.component('Rutas', require('./components/operativo/AdministracionRutas.vue'));
Vue.component('Vuelos', require('./components/operativo/PlanificarVuelos.vue'));
Vue.component('VuelosAbiertos', require('./components/operativo/VuelosAbiertos.vue'));
Vue.component('Taquilla', require('./components/operativo/AdministracionTaquilla.vue'));
Vue.component('SoloIda', require('./components/operativo/taquilla/SoloIda.vue'));
Vue.component('IdayVuelta', require('./components/operativo/taquilla/IdayVuelta.vue'));
Vue.component('Multidestino', require('./components/operativo/taquilla/Multidestino.vue'));


Vue.component('panel', require('./components/reportes/panel.vue'));

const app = new Vue({
    el: '#app'
});
