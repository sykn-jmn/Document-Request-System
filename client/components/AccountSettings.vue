<template>
  <div>
    <form class="account-settings">
        <div class="input-container">
            <h2 class="col-span-3">Full Name</h2>
            <label><input type="text" v-model="firstName">Last Name</label>
            <label><input type="text" v-model="middleName">First Name</label>
            <label class="end-row"><input type="text" v-model="lastName">Middle Name</label>
            <h2>Birthdate</h2>
            <h2 class="col-span-2">Birthplace</h2>
            <label><input type="text" v-model="birthdate">yyyy-mm-dd</label>
            <label class="end-row col-span-2"><input type="text" v-model="birthplace"></label>
            <h2>Sex</h2>
            <h2>Civil Status</h2>
            <h2>Religion</h2>
            <div class="flex space-x-4 pl-8">
                <label for="male"><input type="radio" v-model="sex" value="male" id="male">Male</label>
                <label for="female"><input type="radio" v-model="sex" value="female" id="female">Female</label>
            </div>
            <select v-model="civilStatus">
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
            <label class="col-span-2"><input type="text" v-model="email"></label>
            <label><input type="tel" v-model="mobileNumber" min="11" pattern="[0-9]{11}"></label><br>
            <h2 class="col-span-3">Mother's Maiden Name</h2>
            <label><input type="text" v-model="mothersLastname">Last Name</label>
            <label><input type="text" v-model="mothersFirstname">First Name</label>
            <label class="end-row" ><input type="text" v-model="mothersMiddleName">Middle Name</label>
            <h2 class="col-span-3">Password</h2>
            <label><input type="password" v-model="newPassword" min="8">New Password</label>
            <label><input type="password" v-model="confirmNewPassword" min="8">Retype New Password</label>
        </div>
    </form>
    
  </div>
</template>

<script>
export default {
    data(){
        return{
            firstName:this.$auth.state.user.first_name,
            middleName:this.$auth.state.user.middle_name,
            lastName:this.$auth.state.user.last_name,
            birthdate:this.$auth.state.user.birthdate,
            birthplace:this.$auth.state.user.birthplace,
            sex: this.$auth.state.user.sex,
            civilStatus:this.$auth.state.user.civil_status,
            religion:this.$auth.state.user.religion,
            purok:this.$auth.state.user.purok,
            baranggay:this.$auth.state.user.baranggay,
            zipCode:this.$auth.state.user.zip_code,
            municipality:this.$auth.state.user.municipality,
            province:this.$auth.state.user.province,
            email:this.$auth.state.user.email,
            mobileNumber:this.$auth.state.user.mobile_number,
            mothersLastname:this.$auth.state.user.mothers_lastname,
            mothersFirstname:this.$auth.state.user.mothers_firstname,
            mothersMiddleName:this.$auth.state.user.mothers_middlename,
            newPassword:"",
            confirmNewPassword:"",

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


</style>