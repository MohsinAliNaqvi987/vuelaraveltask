<template>
    <div class="container">
        <div style="height: 600px" class="d-flex justify-content-center">
            <div v-if="!showUpdateForm" style="width: 400px" class="d-flex flex-column justify-content-center">
                <div class="alert alert-success my-2" v-if="alertDisplaySuccess">
                    <strong>{{this.alertMessage }}</strong>
                </div>
                <h1>Dashboard</h1>
                <div class="d-flex justify-content-center my-2">
                    <img v-if="imageName != ''" :src="'http://localhost:8000/imageFolder/'+imageName" style="width: 150px; height: 150px; border-radius: 75px"/>
                    <img v-if="imageName == ''" src="http://localhost:8000/imageFolder/None.png" style="width: 150px; height: 150px; border-radius: 75px"/>
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Name : </label>
                    <input v-model="name" readonly />
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Email : </label>
                    <input v-model="email" readonly />
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Date of birth : </label>
                    <input v-model="DOB" readonly/>
                </div>
                <div class="d-flex justify-content-between my-2">
                    <label>Education : </label>
                    <input v-model="Education" readonly />
                </div>
                <button class="btn btn-primary my-2" v-on:click="openUpdateForm">Update Profile</button>
            </div>
            <UpdateProfile v-if="showUpdateForm" v-bind:email="email" v-on:changeShowUpdateForm="toggleShowUpdateForm($event)" v-on:sendUpdatedUserBack="updateUserData($event)"></UpdateProfile>
        </div>
    </div>
</template>

<script>
import UpdateProfile from "./UpdateProfile";
export default {
    name: "Dashboard",
    components:{UpdateProfile},
    data (){
        return {
            name:'', email:'', Education: '', imageName:'', DOB:null, alertDisplaySuccess:false,alertMessage:'',showUpdateForm:false
        }
    },
    mounted() {
        this.alertDisplaySuccess=true;
        this.alertMessage=this.$route.params.message;
        const user = this.$route.params.user;
        this.name = user.username;
        this.email = user.email;
        this.Education = user.Education;
        this.imageName = user.image;
        this.DOB = user.DOB;
        setTimeout(()=>{
            this.alertDisplaySuccess=false;
            this.alertMessage="";
        }, 3000);
    },
    methods:{
        openUpdateForm(){
            this.showUpdateForm = true;
        },
        toggleShowUpdateForm(data){
            this.showUpdateForm = data;
        },
        updateUserData(data){
            this.showUpdateForm = data.showUpdateForm;
            this.name = data.user.username;
            this.Education = data.user.Education;
            this.imageName = data.user.image;
            this.DOB = data.user.DOB;
            this.alertDisplaySuccess=true;
            this.alertMessage=data.message;
            setTimeout(()=>{
                this.alertDisplaySuccess=false;
                this.alertMessage="";
            }, 3000);
        }
    }
}
</script>

<style scoped>

</style>
