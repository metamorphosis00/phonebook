require('./bootstrap')
import 'es6-promise/auto'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'


Vue.use(VueRouter)
Vue.use(Vuetify)
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`

import App from './components/App'
import Home from './components/Home'
import Manage from './components/Manage'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/manage',
            name: 'manage',
            component: Manage,
        }
    ],
});

Vue.router = router

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    vuetify: new Vuetify()
});
