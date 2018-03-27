//import scss from './assets/stylesheets/app.scss';

import vue from 'vue';
import Router from 'vue-router';
import resource from 'vue-resource';

vue.use(Router);
vue.use(resource);

import appcomponent from './components/app.component.vue';
import cartcomponent from './components/cart/cart.component.vue';
import storecomponent from './components/store/store.component.vue';
import homecomponent from './components/home/home.component.vue';
import logincomponent from './components/login/login.component.vue';
import registercomponent from './components/register/register.component.vue';
import testcomponent from './components/test/test.component.vue';

const routes = [
    {
        path: '/',
        component: testcomponent
    },
    {
        path: '/cart',
        component: cartcomponent
    },
    {
        path: '/store',
        component: storecomponent
    },
    {
        path: '/login',
        component: logincomponent
    },
    {
        path: '/register',
        component: registercomponent
    }
];

const router = new Router({
    routes: routes
});

new vue({
    router:router,
    render: h=>h(appcomponent)
}).$mount('#app');