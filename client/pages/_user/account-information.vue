<template>
  <div class="text-black p-16 min-h-screen">
    <h1>Edit Account Information</h1>
    <form @submit.prevent="save" class="account-settings">
        <h2>Full Name</h2>
        <div class="md:flex space-x-8">
            <label><input type="text" v-model="data.first_name" required>Last Name</label>
            <label><input type="text" v-model="data.middle_name" required>First Name</label>
            <label class="end-row"><input type="text" v-model="data.last_name" required>Middle Name</label>
            <label class="end-row"><input type="text" v-model="data.suffix">Suffix</label>
        </div>
        <div class="input-container">
            <h2>Birthdate</h2>
            <h2>Birthplace</h2>
            <h2>Citizenship</h2>
            <label><input type="date" v-model="data.birthdate" required>yyyy-mm-dd</label>
            <label class="end-row"><input type="text" v-model="data.birthplace"></label>
            <label class="end-row"><input type="text" v-model="data.citizenship"></label>
            <h2>Sex</h2>
            <h2>Civil Status</h2>
            <h2>Religion</h2>
            <div class="flex space-x-4 pl-8">
                <label for="male"><input type="radio" v-model="data.sex" value="male" id="male" required>Male</label>
                <label for="female"><input type="radio" v-model="data.sex" value="female" id="female" required>Female</label>
            </div>
            <select v-model="data.civil_status" required>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="widow">Widow</option>
                <option value="separate">Separate</option>
            </select>
            <label class="end-row"><input type="text" v-model="data.religion"></label>
            <h2 class="col-span-2">Address</h2>
            <h2>ZIP Code</h2>
            <label><input type="text" v-model="data.purok">Purok</label>
            <label><input type="text" v-model="data.barangay">barangay</label>
            <label><input class="end-row" type="text" v-model="data.zip_code"></label>
            <label><input type="text" v-model="data.municipality">Municipality</label>
            <label class="end-row"><input type="text" v-model="data.province">Province</label><br>
            <h2 class="col-span-2">Email</h2>
            <h2>Mobile Number</h2>
            <label class="col-span-2"><input type="text" v-model="data.email" required></label>
            <label><input type="tel" v-model="data.mobile_number" min="11" pattern="[0-9]{11}" required></label><br>
            <h2 class="col-span-3">Mother's Maiden Name</h2>
            <label><input type="text" v-model="data.mothers_lastname" required>Last Name</label>
            <label><input type="text" v-model="data.mothers_firstname" required>First Name</label>
            <label class="end-row" ><input type="text" v-model="data.mothers_middlename" required>Middle Name</label>
            <label><input type="text" v-model="data.fathers_lastname" required>Last Name</label>
            <label><input type="text" v-model="data.fathers_firstname" required>First Name</label>
            <label class="end-row" ><input type="text" v-model="data.fathers_middlename" required>Middle Name</label>
            <!-- <h2 class="col-span-3">Password</h2>
            <label><input type="password" v-model="newPassword" min="8">New Password</label>
            <div class="flex">
                <label><input type="password" v-model="confirmNewPassword" min="8">Retype New Password</label>
                <span class="error">{{errorPass}}</span>
            </div> -->
            
        </div><br>
        <div class="formButtonContainer">
            <button type="submit">Save</button>
        </div>
    </form>
    <UpdateUserModal v-if="updateUserModal" :data="data" @close="updateUserModal = false"/>
    <Spin v-if="spinning" />
  </div>
</template>

<script>
import moment from 'moment'
export default {
    layout:'user',
    data(){
        return{
            updateUserModal:false,
            data:{
            },
            spinning:false
        }
    },
    mounted(){
        this.getUserData()
    },
    // watch:{
    //     confirmNewPassword(){
    //         if(this.newPassword != this.confirmNewPassword){
    //             this.errorPass = "Inconsistent password!"
    //         }else{
    //             this.errorPass = ""
    //         }
    //     }
    // },
    methods:{
        async getUserData(){
            this.spinning = true
            await this.$axios.get('/user/get-details').then(response=>{
                this.data=response.data
                }
            ).then(response=>{
                this.spinning = false
            }).catch(err =>{
                this.spinning = false
            })
        },  
        save(){
            this.updateUserModal = true
            
            // if(this.newPassword != this.confirmNewPassword){
            //     this.errorPass = "Inconsistent password!"
            // }else{
            //     this.errorPass=""   
            // }
        }
    }
}
</script>

<style scoped>
.account-settings{
    @apply bg-white p-8 rounded-xl
}
.input-container{
    @apply grid grid-cols-3 gap-x-8
}
select{
  font-size: 20px;
  @apply border border-blue-700 rounded-md focus:outline-none h-fit p-3
}
.end-row{
    @apply mb-10
}
input[type="radio"]{
  @apply w-fit mr-4
}
label,select{
    @apply text-slate-700
}

input{
    @apply border-black
}
select{
    @apply border-black
}
h2{
    @apply font-medium
}
.formButtonContainer{
    @apply flex space-x-4 m-auto w-fit
}

.formButtonContainer > button[type="cancel"]{
    @apply bg-slate-200 py-2 px-28 rounded-3xl text-2xl
}
.formButtonContainer > button[type="submit"]{
    @apply bg-red-500 py-2 px-28 rounded-lg text-2xl text-white
}
form{
    @apply w-fit
}
h1{
  @apply text-2xl text-black font-bold
}

</style>