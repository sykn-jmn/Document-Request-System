<template>
  <div class="account-settings">
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
    <div class="flex w-fit space-x-4 pl-8">
        <input type="radio" v-model="sex" value="male" id="male" class="text-sm"><label for="male">Male</label>
        <input type="radio" v-model="sex" value="female" id="female"><label for="female">Female</label>
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
    <label><input type="text" v-model="province">Province</label>
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
            civilStatus:this.$auth.state.user.civil_status
        }
    }
}
</script>

<style scoped>
.account-settings{
    @apply grid grid-cols-3 gap-x-8 bg-white p-8 rounded-xl
}
select{
  font-size: 20px;
  @apply border border-blue-700 rounded-md focus:outline-none h-fit p-3
}
.end-row{
    @apply mb-10
}

</style>