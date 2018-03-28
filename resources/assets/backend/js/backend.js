
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import ElementUI from 'element-ui';
import router from './router';
Vue.use(ElementUI);
Vue.component('aside-menu', require('./components/AsideMenu.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    data: {
        isCollapse: false
    },
    methods: {
        menuCollapse: function(event) {
            console.log(111);
        }
    }
});
