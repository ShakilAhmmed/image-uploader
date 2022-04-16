/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";
import VueToastr2 from 'vue-toastr-2';
import 'vue-toastr-2/dist/vue-toastr-2.min.css'

require('./bootstrap');

window.Vue = require('vue').default;
window.toastr = require('toastr');
Vue.use(VueToastr2, {
    "preventDuplicates": true,
    "closeButton": true,
    "positionClass": "toast-bottom-right",
});

import router from './router'

import store from './store'

const app = new Vue({
    el: '#app',
    router,
    store
});
