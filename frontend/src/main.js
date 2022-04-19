import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueLoading from 'vue-loading-overlay';

import "bootstrap/dist/css/bootstrap.css"
import "./assets/global.css"

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

createApp(App).use(store).use(router).use(VueLoading).use(VueSweetalert2).mount('#app')

import "bootstrap/dist/js/bootstrap.js"