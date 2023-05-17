<template>
  <div class="form-wrapper">
    <form class="login-form" onsubmit="return false;">
      <h1>Log In To Your Account</h1><br>
      <input type="text" id="email" name="email" placeholder="Email" v-model="email"><br><br>
      <div class="password-container">
          <input class="border-none" :type="passwordFieldType" id="password" name="password" placeholder="Enter Password" v-model="password" required><font-awesome-icon :icon="['fas', eyeIconType]" class="eyeIcon" @click="showPassword = !showPassword"/>
      </div>
      <p class="error">{{error}}</p><br>
      <p class="text-center text-sky-600"><NuxtLink to="/forgot-password">Forgot your password?</NuxtLink></p>
      <div class="button-wrapper text-center">
          <button class="py-4 bg-yellow-400 rounded-full w-2/3 m-auto font-bold text-white" @click="login">LOGIN</button>
      </div><br>
      <p class="text-center text-sky-600">Don't have an account? <span class="underline font-bold"><NuxtLink to="/register">Signup</NuxtLink></span></p>
    </form>
    <Spin v-if="spinning"/>
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
      error:"",
      spinning:false
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
      this.spinning = true
        await this.$auth.loginWith('userAuth', {
          data: {
            email: this.email,
            password: this.password,
          },
      }).then(response=>{
        this.$router.push("/user/dashboard")
        this.spinning = false
      }).catch(err=>{
        this.error = err.response.data.message
        this.$router.push("/")
        this.spinning = false
      })
        

    },
}
}

    



</script>

<style scoped>
h1{
  @apply text-xl
}

</style>