<template>
    <div style="height: 600px" class="d-flex justify-content-center">
        <div style="width: 400px" class="d-flex flex-column justify-content-center">
            <h1 class="my-2">Reset Password</h1>
            <div class="alert alert-danger my-2" v-if="alertDisplayDanger">
                <strong>{{this.alertMessage}}</strong>
            </div>
            <div class="alert alert-success my-2" v-if="alertDisplaySuccess">
                <strong>{{this.alertMessage }}</strong>
            </div>
            <div class="d-flex justify-content-between my-2">
                <label>Enter Pin Code</label>
                <input type="text" v-model="pinCode" />
            </div>
            <div class="d-flex justify-content-between my-2">
                <label>Enter new password</label>
                <input type="text" v-model="newPass" />
            </div>
            <button class="btn btn-primary my-2" v-on:click="resetPassword">Reset Password</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ResetPassword",
    data(){
        return {
            pinCode:0, newPass:'',alertDisplaySuccess:false,alertDisplayDanger:false,alertMessage:''
        }
    },
    methods:{
        resetPassword(){
            this.$axios.post("/vueapp/resetPassword", {
                pinCode:this.pinCode,
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

<style scoped>

</style>
