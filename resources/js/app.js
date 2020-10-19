import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Imoveis from './views/imoveis/Index'
import Contratos from './views/contratos/Index'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'imoveis',
            component: Imoveis,
        },
        {
            path: '/contratos',
            name: 'contratos',
            component: Contratos,
        },
    ],
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
