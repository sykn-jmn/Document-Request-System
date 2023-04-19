<template>
  <div class="account-settings">
    <h2 class="col-span-3">Full Name</h2>
    <label><input type="text" v-model="firstName">Last Name</label>
    <label><input type="text" v-model="middleName">First Name</label>
    <label><input type="text" v-model="lastName">Middle Name</label>
    <h2>Birthdate</h2>
    <h2 class="col-span-2">Birthplace</h2>
    <label><input type="text" v-model="birthdate">yyyy-mm-dd</label>
    <label class="col-span-2"><input type="text" v-model="birthplace"></label>
    <h2>Sex</h2>
    <h2>Civil Status</h2>
    <h2>Religion</h2>
    <div class="flex w-fit space-x-4 pl-8">
        <input type="radio" v-model="sex" value="male" id="male" class="text-sm"><label for="male">Male</label><br>
        <input type="radio" v-model="sex" value="female" id="female"><label for="female">Female</label>
    </div>
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
            sex: this.$auth.state.user.sex
        }
    }
}
</script>

<style scoped>
.account-settings{
    @apply grid grid-cols-3 gap-4 bg-white p-8 rounded-xl
}

</style>