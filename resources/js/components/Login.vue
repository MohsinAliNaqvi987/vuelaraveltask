<template>
    <div class="container">
        <div style="height: 600px" class="d-flex justify-content-center">
            <div v-if="!showForgetForm" style="width: 400px" class="d-flex flex-column justify-content-center">
                <h1 class="my-2">Login</h1>
                <div class="alert alert-danger my-2" v-if="alertDisplayDanger">
                    <strong>{{this.alertMessage}}</strong>
                </div>
                <div class="alert alert-success my-2" v-if="alertDisplaySuccess">
                    <strong>{{this.alertMessage }}</strong>
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Email</label>
                    <input type="text" v-model="email" />
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Password</label>
                    <input type="text" v-model="pass" />
                </div>
                <button class="btn btn-primary my-2" v-on:click="login">Login</button>
                <button class="btn btn-primary my-2" v-on:click="openForgetForm">Forget Password</button>
                <GoogleLogin class="btn btn-primary" :params="params" :onSuccess="onSuccess" :onFailure="onFailure">Continue with Google</GoogleLogin>
            </div>
            <ForgetPassword v-if="showForgetForm" v-on:changeShowForgetForm="toggleShowForgetForm($event)"></ForgetPassword>
        </div>
    </div>
</template>

<script>
import GoogleLogin from 'vue-google-login';
import ForgetPassword from "./ForgetPassword";

export default {
    name: "Login",
    components: {ForgetPassword, GoogleLogin},
    data(){
        return {
            params: {
                client_id: "39706275925-gss3if7l3oj1moc3bk125cslqbnkoo3o.apps.googleusercontent.com"
            },
            email:'',pass:'',alertDisplaySuccess:false,alertDisplayDanger:false,alertMessage:'',showForgetForm:false,showUpdateForm:false
        }
    },
    methods:{
        onSuccess(googleUser) {
            var user = googleUser.getBasicProfile();
            this.$axios.post("/vueapp/googleLogin", {
                email:user.getEmail(),
            })
                .then(res => {
                    this.$router.push({name:`dashboard`, params:{user: res.data.data, message:"Successfully Logged In"}});
                })
                .catch(err => {
                    this.alertDisplayDanger=true;
                    this.alertMessage=err.response.data.error;
                    setTimeout(()=>{
                        this.alertDisplayDanger=false;
                        this.alertMessage="";
                    }, 3000);
                })
        },
        onFailure(){
            this.alertDisplayDanger=true;
            this.alertMessage="Authentication Failed";
            setTimeout(()=>{
                this.alertDisplayDanger=false;
                this.alertMessage="";
            }, 3000);
        },
        openForgetForm(){
            this.showForgetForm = true;
        },
        toggleShowForgetForm(data){
            this.showForgetForm = data;
        },
        login(){
            this.$axios.post("/vueapp/login", {
                email:this.email,
                password:this.pass
            })
                .then(res => {
                    this.$router.push({name:`dashboard`, params:{user: res.data.data, message:"Successfully Logged In"}});
                })
                .catch(err => {
                    this.alertDisplayDanger=true;
                    this.alertMessage=err.response.data.error;
                    setTimeout(()=>{
                        this.alertDisplayDanger=false;
                        this.alertMessage="";
                    }, 3000);
                })
        }
    }
}
</script>

<style scoped></style>
