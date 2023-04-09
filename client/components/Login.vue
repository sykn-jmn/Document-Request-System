<template>
  <div class="form-wrapper">
    <form class="login-form" onsubmit="return false;">
      <h1>Log In To Your Account</h1><br><br>
      <input type="text" id="email" name="email" placeholder="Email" v-model="email"><br><br>
      <div class="password-container">
          <input class="border-none" :type="passwordFieldType" id="password" name="password" placeholder="Enter Password" required><font-awesome-icon :icon="['fas', eyeIconType]" class="eyeIcon" @click="showPassword = !showPassword"/>
      </div><br><br>
      <p class="text-center text-sky-600"><NuxtLink to="https://nuxtjs.org">Forgot your password?</NuxtLink></p><br><br>
      <div class="button-wrapper text-center">
          <button class="py-4 bg-yellow-400 rounded-full w-2/3 m-auto font-bold text-white" @click="login">LOGIN</button>
      </div><br><br>
      <p class="text-center text-sky-600">Don't have an account? <span class="underline font-bold"><NuxtLink to="/register">Signup</NuxtLink></span></p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data(){
    return{
      email:"",
      password:"",
      passwordFieldType:"password",
      eyeIconType:"eye-slash",
      showPassword:false,
    }
  },
  watch:{
    showPassword(){
        if(this.showPassword){
            this.passwordFieldType = "text"
            this.eyeIconType = "eye"
        }else{
            this.passwordFieldType = "password"
            this.eyeIconType = "eye-slash"
        }
    },
  },
  methods:{
    async login(){
        await this.$auth.loginWith('laravelSanctum', {
        data: {
          email: this.email,
          password: this.password,
        },
      }).then(response => {

        console.log(response.data)
        this.$router.push('/user/dashboard')
      })
    
    },
}
}

    



</script>

<style>

</style>