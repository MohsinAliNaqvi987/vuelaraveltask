import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from 'axios';
import GoogleSignInButton from 'vue-google-signin-button-directive';

window.Vue = require('vue').default;

Vue.prototype.$axios = axios;

Vue.component('App', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
    GoogleSignInButton
});
