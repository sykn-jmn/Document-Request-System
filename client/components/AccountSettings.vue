<template>
  <div>
    <form @submit.prevent="save" class="account-settings">
        <div class="input-container">
            <h2 class="col-span-3">Full Name</h2>
            <label><input type="text" v-model="firstName" required>Last Name</label>
            <label><input type="text" v-model="middleName" required>First Name</label>
            <label class="end-row"><input type="text" v-model="lastName" required>Middle Name</label>
            <h2>Birthdate</h2>
            <h2 class="col-span-2" required>Birthplace</h2>
            <label><input type="date" v-model="birthdate" required>yyyy-mm-dd</label>
            <label class="end-row col-span-2"><input type="text" v-model="birthplace"></label>
            <h2>Sex</h2>
            <h2>Civil Status</h2>
            <h2>Religion</h2>
            <div class="flex space-x-4 pl-8">
                <label for="male"><input type="radio" v-model="sex" value="male" id="male" required>Male</label>
                <label for="female"><input type="radio" v-model="sex" value="female" id="female" required>Female</label>
            </div>
            <select v-model="civilStatus" required>
                <option value="single">Single</option>
                <option value="married">Married</option>
            </select>
            <label class="end-row"><input type="text" v-model="religion"></label>
            <h2 class="col-span-2">Address</h2>
            <h2>ZIP Code</h2>
            <label><input type="text" v-model="purok">Purok</label>
            <label><input type="text" v-model="baranggay">Baranggay</label>
            <label><input class="end-row" type="text" v-model="zipCode"></label>
            <label><input type="text" v-model="municipality">Municipality</label>
            <label class="end-row"><input type="text" v-model="province">Province</label><br>
            <h2 class="col-span-2">Email</h2>
            <h2>Mobile Number</h2>
            <label class="col-span-2"><input type="text" v-model="email" required></label>
            <label><input type="tel" v-model="mobileNumber" min="11" pattern="[0-9]{11}" required></label><br>
            <h2 class="col-span-3">Mother's Maiden Name</h2>
            <label><input type="text" v-model="mothersLastname" required>Last Name</label>
            <label><input type="text" v-model="mothersFirstname" required>First Name</label>
            <label class="end-row" ><input type="text" v-model="mothersMiddleName" required>Middle Name</label>
            <h2 class="col-span-3">Password</h2>
            <label><input type="password" v-model="newPassword" min="8">New Password</label>
            <div class="flex">
                <label><input type="password" v-model="confirmNewPassword" min="8">Retype New Password</label>
                <span class="error">{{errorPass}}</span>
            </div>
            
        </div><br>
        <div class="formButtonContainer">
            <button type="submit">Save</button>
        </div>
    </form>
    <Spin v-if="spinning" />
  </div>
</template>

<script>
import moment from 'moment'
export default {
    data(){
        return{
            firstName:this.$auth.$state.user.first_name,
            middleName:this.$auth.$state.user.middle_name,
            lastName:this.$auth.$state.user.last_name,
            birthdate:this.$auth.$state.user.birthdate,
            birthplace:this.$auth.$state.user.birthplace,
            gender:this.$auth.$state.user.gender,
            sex: this.$auth.$state.user.sex,
            civilStatus:this.$auth.$state.user.civil_status,
            religion:this.$auth.$state.user.religion,
            purok:this.$auth.$state.user.purok,
            baranggay:this.$auth.$state.user.baranggay,
            zipCode:this.$auth.$state.user.zip_code,
            municipality:this.$auth.$state.user.municipality,
            province:this.$auth.$state.user.province,
            email:this.$auth.$state.user.email,
            mobileNumber:this.$auth.$state.user.mobile_number,
            mothersLastname:this.$auth.$state.user.mothers_lastname,
            mothersFirstname:this.$auth.$state.user.mothers_firstname,
            mothersMiddleName:this.$auth.$state.user.mothers_middlename,
            newPassword:"",
            confirmNewPassword:"",
            errorPass:"",
            spinning:false,
        }
    },
    mounted(){
        this.getUserData()
    },
    watch:{
        confirmNewPassword(){
            if(this.newPassword != this.confirmNewPassword){
                this.errorPass = "Inconsistent password!"
            }else{
                this.errorPass = ""
            }
        }
    },
    methods:{
        async getUserData(){
            this.spinning = true
            await this.$axios.get('/user/get-details').then(response=>{
                    this.firstName=response.data.first_name
                    this.middleName=response.data.middle_name
                    this.lastName=response.data.last_name
                    this.birthdate=response.data.birthdate
                    this.birthplace=response.data.birthplace
                    this.gender=response.data.gender
                    this.sex=response.data.sex
                    this.civilStatus=response.data.civil_status
                    this.religion=response.data.religion
                    this.purok=response.data.purok
                    this.baranggay=response.data.baranggay
                    this.zipCode=response.data.zip_code
                    this.municipality=response.data.municipality
                    this.province=response.data.province
                    this.email=response.data.email
                    this.mobileNumber=response.data.mobile_number
                    this.mothersLastname=response.data.mothers_lastname
                    this.mothersFirstname=response.data.mothers_firstname
                    this.mothersMiddleName=response.data.mothers_middlename
                }
            ).then(response=>{
                this.spinning = false
            }).catch(err =>{
                this.spinning = false
            })
        },  
        async save(){
            this.spinning = true
            if(this.newPassword != this.confirmNewPassword){
                this.errorPass = "Inconsistent password!"
            }else{
                this.errorPass=""
                var params = {
                    first_name:this.firstName,
                    middle_name:this.middleName,
                    last_name:this.lastName,
                    birthdate:this.birthdate,
                    birthplace:this.birthplace,
                    sex: this.sex,
                    civil_status:this.civilStatus,
                    religion:this.religion,
                    purok:this.purok,
                    baranggay:this.baranggay,
                    zip_code:this.zipCode,
                    municipality:this.municipality,
                    province:this.province,
                    email:this.email,
                    mobile_number:this.mobileNumber,
                    mothers_lastname:this.mothersLastname,
                    mothers_firstname:this.mothersFirstname,
                    mothers_middlename:this.mothersMiddleName,
                    password: this.newPassword,
                    gender:this.gender
            }
            await this.$axios.put('/user/update-user', params).then(response=>{
                    this.getUserData()
                    this.spinning = false
                }).catch(err=>{
                    this.spinning = false
                })
            }
        },
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
    @apply bg-yellow-400 py-2 px-28 rounded-3xl text-2xl
}

</style>