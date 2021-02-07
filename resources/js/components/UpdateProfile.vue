<template>
    <div style="width: 400px" class="d-flex flex-column justify-content-center">
        <h1 class="my-2">Update Profile</h1>
        <div class="alert alert-danger my-2" v-if="alertDisplayDanger">
            <strong>{{this.alertMessage}}</strong>
        </div>
        <div class="alert alert-success my-2" v-if="alertDisplaySuccess">
            <strong>{{this.alertMessage }}</strong>
        </div>
        <div class="d-flex justify-content-between my-2">
            <label>Enter New Name</label>
            <input type="text" v-model="newName" />
        </div>
        <div class="d-flex justify-content-between my-2">
            <label>Picture</label>
            <input type="file" style="width: 205px" @change="fileChanged" />
        </div>
        <div class="d-flex justify-content-between my-2">
            <label>Enter date of birth</label>
            <input type="date" v-model="dob" />
        </div>
        <div class="d-flex justify-content-between my-2">
            <label>Enter Education</label>
            <input type="text" v-model="education" />
        </div>
        <button class="btn btn-primary my-2" v-on:click="updateProfile">Update Profile</button>
        <button class="btn btn-primary my-2" v-on:click="goBackFromUpdate">Back</button>
    </div>
</template>

<script>
export default {
    name: "UpdatePassword",
    props:['email'],
    data(){
        return {
            alertDisplaySuccess:false,alertDisplayDanger:false,alertMessage:'',newName:'',image:null,dob:null,education:''
        }
    },
    methods:{
        fileChanged(e){
            this.image = e.target.files[0];
        },
        goBackFromUpdate(){
            this.$emit('changeShowUpdateForm', false);
        },
        updateProfile(){
            var config = {
                headers: {  'content-type':'multipart/form-data' }
            };
            const formData = new FormData();
            formData.append("email", this.email);
            formData.append("newName", this.newName);
            formData.append("image", this.image);
            formData.append("dob", this.dob);
            formData.append("education", this.education);
            this.$axios.post("/vueapp/updateProfile", formData, config)
                .then(res => {
                    console.log(res.data.data);
                    this.$emit('sendUpdatedUserBack', {user: res.data.data, message:"Updated Profile Successfully", showUpdateForm: false});
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
