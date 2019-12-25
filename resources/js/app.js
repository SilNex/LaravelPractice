import BootstrapVue from 'bootstrap-vue'

require('./bootstrap');

window.Vue = require('vue');

Vue.use(BootstrapVue)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
