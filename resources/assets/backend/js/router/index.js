import Vue from 'vue';
import Router from 'vue-router';

import Dashboard from '../components/Dashboard';
import Password from '../components/Password';
import Infomation from '../components/Infomation';
import Admin from '../components/role/Admin';
import AdminCreate from '../components/role/AdminCreate';
import AdminEdit from '../components/role/AdminEdit';

import PermissionIndex from '../components/role/PermissionIndex';

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
    path: '/admin',
    name: 'admin-index',
    component: Admin
  },
  {
    path: '/admin/create',
    name: 'admin-create',
    component: AdminCreate
  },
  {
    path: '/admin/edit/:id',
    name: 'admin-edit',
    component: AdminEdit
  },
  {
    path: '/permission',
    name: 'permission-index',
    component: PermissionIndex
  }
];


const router = new Router({
  routes
})

export default router;
