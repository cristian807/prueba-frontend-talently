require('./bootstrap');

import Vue from 'vue'
import router from './routes';
import store from './store/index'
import main from './views/main.vue'
import VueToastr from "vue-toastr";

Vue.use(VueToastr)

const app=new Vue({
    'el':'#app',
    router,
    store,
    render: h=>h(main)
});

