<template>
  <div class="account-container">
    <h1>Profile Preview</h1><br>
    <UserProfilePreview /><br>
    <div class="md:flex justify-between items-center mb-2">
      <h1>Account Settings</h1>
      <div class="text-white md:flex space-x-4">
        <button class="bg-red-600 p-2 md:flex items-center space-x-4" @click="$router.push('/user/account-information')"><font-awesome-icon :icon="['fas', 'pen-to-square']"/><p>Edit Information</p></button>
        <button class="bg-red-600 p-2 md:flex items-center space-x-4" @click="changePasswordModal=true"><font-awesome-icon :icon="['fas', 'lock']" /><p>Change Password</p></button>
      </div>
    </div>  
    
    <UserAccountInformation />
    <ChangeUserPasswordModal v-if="changePasswordModal" @close="changePasswordModal = !changePasswordModal"/>
  </div>
</template>

<script>
export default {
    layout:'user',
    data(){
      return{
        fullName:this.$auth.state.user.first_name + " " + this.$auth.state.user.middle_name + " " + this.$auth.state.user.last_name,
        user:this.$auth.state.user,
        changePasswordModal:false,
      }
    }
}
</script>

<style scoped>
.account-container{
  @apply text-black p-16 min-h-screen
}
h1{
  @apply text-2xl text-black font-bold
}
</style>