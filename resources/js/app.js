import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from 'axios';
import GoogleSignInButton from 'vue-google-signin-button-directive';
import Router  from 'vue-router';
import Dashboard from './components/Dashboard';
import Signup from "./components/Signup";
import ResetPassword from "./components/ResetPassword";

window.Vue = require('vue').default;

Vue.prototype.$axios = axios;
Vue.component('App', require('./components/App.vue').default);
Vue.use(Router);

const router = new Router({
    routes: [
        { path: '/', component: Signup},
        { path: '/dashboard/', name:'dashboard', component: Dashboard},
        { path: '/resetpassword/', component: ResetPassword},
    ],
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router
});
