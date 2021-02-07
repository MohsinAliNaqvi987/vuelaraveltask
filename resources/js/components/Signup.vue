<template>
    <div class="container">
        <div style="height: 600px" class="d-flex justify-content-center">
            <div v-if="!showLoginForm" style="width: 400px" class="d-flex flex-column justify-content-center">
                <h1 class="my-2">Sign Up</h1>
                <div class="alert alert-danger my-2" v-if="alertDisplayDanger">
                    <strong>{{this.alertMessage}}</strong>
                </div>
                <div class="alert alert-success my-2" v-if="alertDisplaySuccess">
                    <strong>{{this.alertMessage }}</strong>
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Username</label>
                    <input type="text" v-model="username" />
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Email</label>
                    <input type="text" v-model="email" />
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Password</label>
                    <input type="text" v-model="pass" />
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Confirm Password</label>
                    <input type="text" v-model="cpass"/>
                </div>
                <p>Already have an account. <a v-on:click="openLoginForm" class="my-2" style="color:blue; cursor: pointer; text-decoration: underline">Click here to login.</a></p>
                <button class="btn btn-primary my-2" v-on:click="submit">Sign Up</button>
                <GoogleLogin class="btn btn-primary" :params="params" :onSuccess="onSuccess" :onFailure="onFailure">Continue with Google</GoogleLogin>
            </div>
            <Login v-if="showLoginForm"></Login>
        </div>
    </div>
</template>

<script>
import GoogleLogin from 'vue-google-login';
import ForgetPassword from "./ForgetPassword";
import Login from "./Login";

export default {
    name: "Signup",
    components: {ForgetPassword, Login, GoogleLogin},
    data(){
        return {
            params: {
                client_id: "39706275925-gss3if7l3oj1moc3bk125cslqbnkoo3o.apps.googleusercontent.com"
            },
            username:'',email:'',pass:'',cpass:'',alertDisplaySuccess:false,alertDisplayDanger:false,alertMessage:'',showLoginForm:false
        }
    },
    methods:{
        onSuccess(googleUser) {
            var user = googleUser.getBasicProfile();
            this.$axios.post("/vueapp/signup", {
                username:user.getName(),
                email:user.getEmail(),
                password:"11111111",
                confirmPassword:"11111111"
            })
                .then(res => {
                    this.$router.push({name:`dashboard`, params:{user: res.data.data, message:"Successfully Signed Up. Your Password is 11111111."}});
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
        openLoginForm(){
            this.showLoginForm = true;
        },
        toggleShowLoginForm(data){
            this.showLoginForm = data;
        },
        submit(){
            this.$axios.post("/vueapp/signup", {
                username:this.username,
                email:this.email,
                password:this.pass,
                confirmPassword:this.cpass
            })
                .then(res => {
                    this.$router.push({name:`dashboard`, params:{user: res.data.data, message:"Successfully Signed Up"}});
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
