<template>
    <div style="width: 400px" class="d-flex flex-column justify-content-center">
        <h1 class="my-2">Forget Password</h1>
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
            <label>Enter New Password</label>
            <input type="text" v-model="newPass" />
        </div>
        <button class="btn btn-primary my-2" v-on:click="forgetPassword">Submit</button>
        <button class="btn btn-primary my-2" v-on:click="goBackFromForget">Back</button>
    </div>
</template>

<script>
export default {
    name: "ForgetPassword",
    data(){
        return {
            email:'',alertDisplaySuccess:false,alertDisplayDanger:false,alertMessage:'',newPass:''
        }
    },
    methods:{
        goBackFromForget(){
            this.$emit('changeShowForgetForm', false);
        },
        forgetPassword(){
            this.$axios.post("/vueapp/forgetPassword", {
                email:this.email,
                newPassword:this.newPass
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
                })
        }
    }
}
</script>
