<template>
  <div class="account-container">
    <h1>Profile Preview</h1><br>
    <ProfilePreview /><br>
    <h1>Account Settings</h1>
    <AccountInformation />
  </div>
</template>

<script>
export default {
    layout:'user',
    data(){
      return{
        fullName:this.$auth.state.user.first_name + " " + this.$auth.state.user.middle_name + " " + this.$auth.state.user.last_name,
        user:this.$auth.state.user
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