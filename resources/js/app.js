import BootstrapVue from 'bootstrap-vue'
import axios from 'axios'

require('./bootstrap');

window.Vue = require('vue');

Vue.use(BootstrapVue)

const app = new Vue({
    el: '#app',
    components: {
        'main-content': require('./components/MainContent.vue').default,
        'main-menu': require('./components/MainMenu.vue').default,
        'sub-menu': require('./components/SubMenu.vue').default
    }
});
