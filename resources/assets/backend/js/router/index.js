import Vue from 'vue';
import Router from 'vue-router';
import Dashboard from '../components/Dashboard.vue';
import Password from '../components/Password';
import Infomation from '../components/Infomation';
Vue.use(Router);

// import Index from '../'
const routes = [
    {
        path: '/',
        name: 'Index',
        component: Dashboard
    },
    {
        path: '/password',
        name: 'password',
        component: Password
    },
    {
        path: '/infomation',
        name: 'infomation',
        component: Infomation
    }
];


const router = new Router({
    routes
})

export default router;
