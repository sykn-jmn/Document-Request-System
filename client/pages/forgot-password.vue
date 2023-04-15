<template>
  <div class="">
    <h1 class="text-center text-3xl">{{appName}}</h1>
    <form @submit.prevent="submitEmail" class="forgotPasswordForm">
      <h2 class="text-sky-900 font-black text-2xl">Find your eDokumento Account</h2><br>
      <p>Enter the email associated with your account to change the password.</p><br>
      <input type="email" v-model="email" placeholder="Email" class="mt-8">
      <p class="error" v-if="error">{{error}}</p>
      <div class="button-wrapper text-center">
        <button class="py-4 bg-yellow-500 rounded-full w-80 m-auto font-bold text-white text-2xl shadow-xl">Next</button>
     </div>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return{
      email:"",
      error:"",
    }
  },
  computed: {
    appName() {
        return process.env.NUXT_ENV_APP_NAME;
    },
  },
  methods:{
    submitEmail(){
      var params = {
        email: this.email
      }
      this.$axios.get("/user/check-email/", {params}).then(response=>{
          if(!response.data.isEmailExist){
            this.error = "Email address does not exist in the record"
          }
        }
      )
    }
  }
}
</script>

<style scoped>
.forgotPasswordForm{
  width: 400px;
  @apply bg-white w-fit px-8 pt-32 pb-16 text-slate-600 m-auto rounded-2xl mt-8
}
h1{
  @apply mt-24
}

</style>