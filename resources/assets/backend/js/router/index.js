import Vue from 'vue';
import Router from 'vue-router';

import Dashboard from '../components/Dashboard';
import Password from '../components/Password';
import Infomation from '../components/Infomation';
import Admins from '../components/role/Admins';

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
    },
    {
        path: '/admins',
        name: 'admins',
        component: Admins
    }
];


const router = new Router({
    routes
})

export default router;
