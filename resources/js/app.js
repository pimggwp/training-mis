require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate'
import VueApexCharts from 'vue-apexcharts'
import VueRouter from 'vue-router'

Vue.component('apexchart', VueApexCharts)

Vue.use(VueRouter)
Vue.use(Vuetify)
Vue.use(VeeValidate);

Vue.component('navbar', require('./components/navbar.vue').default);

Vue.component('event', require('./components/page/event.vue').default);
Vue.component('save-training', require('./components/page/saveTraining.vue').default);
Vue.component('user-manage', require('./components/page/staff/userManage.vue').default);
Vue.component('personal-report', require('./components/page/personal-report.vue').default);
Vue.component('employee', require('./components/page/employee.vue').default);
Vue.component('course', require('./components/page/course.vue').default);
Vue.component('employee-event', require('./components/page/employee-event.vue').default);
Vue.component('main-menu', require('./components/page/staff/mainMenu.vue').default);


const app = new Vue({
    el: '#app',
});