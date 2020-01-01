import BootstrapVue from 'bootstrap-vue'

require('./bootstrap');

window.Vue = require('vue');

Vue.use(BootstrapVue)

Vue.component('main-menu', require('./components/MainMenu.vue').default);
Vue.component('sub-menu', require('./components/SubMenu.vue').default);
Vue.component('main-content', require('./components/MainContent.vue').default);

const app = new Vue({
    el: '#app',
});

console.log('Deployed!')
