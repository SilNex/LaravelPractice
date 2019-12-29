import BootstrapVue from 'bootstrap-vue'

require('./bootstrap');

window.Vue = require('vue');

Vue.use(BootstrapVue)

// Vue.component('main-nav', require('./components/MainNav.vue').default);

const app = new Vue({
    el: '#app',
});
