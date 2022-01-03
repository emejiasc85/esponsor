require('./bootstrap');

import Vue from 'vue';

import VueTailwindModal from "vue-tailwind-modal"
Vue.component("VueTailwindModal", VueTailwindModal)

import VueCompositionAPI from '@vue/composition-api'
Vue.use(VueCompositionAPI)

Vue.component('admin-products', require('./components/admin/Products.vue').default);
Vue.component('guest-products', require('./components/guest/Products.vue').default);

// creating a vue instance
const app = new Vue({
    el: '#app'
}); 