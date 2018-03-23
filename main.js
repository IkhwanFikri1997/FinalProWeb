import scss from './assets/stylesheets/app.scss';

import vue from 'vue';
import Router from 'vue-router';
import resource from 'vue-resource';

Vue.use(router);
Vue.use(resource);

import appcomponent from './components/app.component.vue';
import cartcomponent from './components/cart.component.vue';
import storecomponent from './components/store.component.vue';
import homecomponent from './components/home.component.vue';
import logincomponent from './components/login.component.vue';
import registercomponent from './components/register.component.vue';
import testcomponent from './components/test/test.component.vue';

const routes = [
    {
        path: '/',
        component: testcomponent
    }
]

const router = new Router({
    routes: routes
});

new vue({
    router:router,
    render: h=>h(appcomponent)
}).$mount('#app');