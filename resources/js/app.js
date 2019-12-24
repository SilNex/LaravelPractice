import BootstrapVue from 'bootstrap-vue'

require('./bootstrap');

window.Vue = require('vue');
Vue.use(BootstrapVue)
const app = new Vue({
    el: '#app',
});
