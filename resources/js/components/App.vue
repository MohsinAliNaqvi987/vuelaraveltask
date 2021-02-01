<template>
    <div id="app">
        <div class="container">
            <div style="height: 600px" class="d-flex justify-content-center">
                <div v-if="!showForgetForm && !showUpdateForm" style="width: 400px" class="d-flex flex-column justify-content-center">
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
                    <p class="my-2"><a v-on:click="openForgetForm" style="color: blue; text-decoration: underline; cursor:pointer">Click here</a> if you forget your password.</p>
                    <p class="my-2"><a v-on:click="openUpdateForm" style="color: blue; text-decoration: underline; cursor:pointer">Update</a> your profile.</p>
                    <button class="btn btn-primary my-2" v-on:click="submit">Sign Up</button>
                    <button v-google-signin-button="clientId" class="btn btn-primary my-2"> Continue with Google</button>
                </div>
                <ForgetPassword v-if="showForgetForm" v-on:changeShowForgetForm="toggleShowForgetForm($event)"></ForgetPassword>
                <UpdatePassword v-if="showUpdateForm" v-on:changeShowUpdateForm="toggleShowUpdateForm($event)"></UpdatePassword>
            </div>
        </div>
    </div>
</template>

<script>
import ForgetPassword from "./ForgetPassword";
import UpdatePassword from "./UpdatePassword";
export default {
    name: 'app',
    components: {ForgetPassword, UpdatePassword},
    data(){
        return {
            username:'',email:'',pass:'',cpass:'',alertDisplaySuccess:false,alertDisplayDanger:false,alertMessage:'',showForgetForm:false,showUpdateForm:false,clientId:'39706275925-09fird1s5l3j8d2hvltho3uil2b2furb.apps.googleusercontent.com'
        }
    },
    methods:{
        OnGoogleAuthSuccess (idToken) {
            console.log(idToken)
            this.alertDisplaySuccess=true;
            this.alertMessage='Successfully authenticated from Google';
            setTimeout(()=>{
                this.alertDisplaySuccess=false;
                this.alertMessage="";
            }, 3000);
            // Receive the idToken and make your magic with the backend
        },
        OnGoogleAuthFail (error) {
            console.log(error)
            this.alertDisplayDanger=true;
            this.alertMessage=error.error;
            setTimeout(()=>{
                this.alertDisplayDanger=false;
                this.alertMessage="";
            }, 3000);
        },
        openForgetForm(){
            this.showForgetForm = true;
        },
        openUpdateForm(){
            this.showUpdateForm = true;
        },
        toggleShowForgetForm(data){
            this.showForgetForm = data;
        },
        toggleShowUpdateForm(data){
            this.showUpdateForm = data;
        },
        submit(){
            this.$axios.post("/vueapp/signup", {
                username:this.username,
                email:this.email,
                password:this.pass,
                confirmPassword:this.cpass
            })
                .then(res => {
                    this.alertDisplaySuccess=true;
                    this.alertMessage=res.data.message;
                    setTimeout(()=>{
                        this.alertDisplaySuccess=false;
                        this.alertMessage="";
                    }, 3000);
                })
                .catch(err => {
                    this.alertDisplayDanger=true;
                    this.alertMessage=err.response.data.error;
                    setTimeout(()=>{
                        this.alertDisplayDanger=false;
                        this.alertMessage="";
                    }, 3000);
                });
        }
    }
}
</script>

<!-- CSS libraries -->
<style src="normalize.css/normalize.css"></style>

<!-- Global CSS -->
<style>
code {
    font-family: Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif;
    font-size: 0.9em;
    white-space: pre-wrap;
    color: #2c3e50;
}

code::before, code::after {
    content: '`';
}

</style>

<!-- Scoped component css -->
<!-- It only affect current component -->
<style scoped>
#app {
    text-align: center;
}

#app h1 {
    color: #2c3e50;
    font-weight: 300;
    margin: 0;
}

.banner {
    height: 200px;
    background-color: #f6f6f6;
    padding: 50px 10px;
}

.bottom {
    padding: 80px 10px;
    font-size: 24px;
    font-weight: 300;
}

.fade {
    font-size: 14px;
}

.logo {
    animation: spin 4s 1s infinite linear
}

@keyframes spin {
    from {transform:rotate(0deg);}
    to {transform:rotate(360deg);}
}
</style>
