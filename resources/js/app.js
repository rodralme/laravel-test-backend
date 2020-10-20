import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Imoveis from './views/imoveis/Index'
import FormImoveis from './views/imoveis/Form'
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
            path: '/imoveis/novo',
            name: 'cadastro-imoveis',
            component: FormImoveis,
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
