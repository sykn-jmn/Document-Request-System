<template>
  <div class="">
    <h1 class="text-center text-3xl">{{appName}}</h1>
    <form @submit.prevent="submitEmail" class="forgotPasswordForm" v-if="firstForm">
      <h2 class="text-sky-900 font-black text-2xl">Forgot Your Password?</h2><br>
      <p>Enter the email associated with your account to change the password.</p><br>
      <input type="email" v-model="email" placeholder="Email" class="mt-8">
      <p class="error" v-if="errorEmail">{{errorEmail}}</p>
      <div class="button-wrapper text-center">
        <button class="py-4 bg-yellow-500 rounded-full w-80 m-auto font-bold text-white text-2xl shadow-xl">Next</button>
     </div>
    </form>
    <form @submit.prevent="verifyCode" class="forgotPasswordForm" v-if="secondform">
      <h2 class="text-sky-900 font-black text-2xl">Code Verification</h2><br>
      <p>Enter 4-digit verification code sent to {{email}}</p><br>
      <input type="text" v-model="code" class="mt-8">
      <p class="error" v-if="error">{{errorCode}}</p>
      <div class="button-wrapper text-center">
        <button class="py-4 bg-yellow-500 rounded-full w-80 m-auto font-bold text-white text-2xl shadow-xl">Verify Code</button>
     </div>
    </form>
    <form @submit.prevent="submitNewPassword" class="forgotPasswordForm" v-if="thirdForm">
      <h2 class="text-sky-900 font-black text-2xl">Create New Password</h2><br>
      <p>Make sure your new password is 8 characters or more. Try including numbers, letters, &amp; punctuation marks for a strong password</p><br>
      <div class="password-container">
          <input class="border-none" :type="passwordFieldType" id="password" name="password" v-model="data.password" placeholder="Enter Password" required><font-awesome-icon :icon="['fas', eyeIconType]" class="eyeIcon" @click="showPassword = !showPassword"/>
      </div><br><br>
      <div class="password-container" >
          <input class="border-none" :type="confirmPasswordFieldType" id="confirm_password" v-model="confirmPassword" name="confirm_password" placeholder="Confirm Password" required><font-awesome-icon :icon="['fas', confirmEyeIconType]" class="eyeIcon" @click="showConfirmPassword = !showConfirmPassword"/>
      </div>
      <p class="error" v-if="error">{{errorCode}}</p>
      <div class="button-wrapper text-center">
        <button class="py-4 bg-yellow-500 rounded-full w-80 m-auto font-bold text-white text-2xl shadow-xl">Verify Code</button>
     </div>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return{
      email:"",
      errorEmail:"",
      errorCode:"",
      code:"",
      firstForm:false,
      secondForm:true,
      thirdForm:false,
      passwordFieldType:"password",
      confirmPasswordFieldType:"password",
      eyeIconType:"eye-slash",
      confirmEyeIconType:"eye-slash",
      showPassword:false,
      showConfirmPassword:false,
      confirmPassword:'',
      password:'',
    }
  },
  computed: {
    appName() {
        return process.env.NUXT_ENV_APP_NAME;
    },
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
        showConfirmPassword(){
            if(this.showConfirmPassword){
                this.confirmPasswordFieldType = "text"
                this.confirmEyeIconType = "eye"
            }else{
                this.confirmPasswordFieldType = "password"
                this.confirmEyeIconType = "eye-slash"
            }
        },
        confirmPassword(){
            if(this.data.password != this.confirmPassword){
                this.error = "Inconsistent password!"
            }else{
                this.error = ""
            }
        },
        'data.birthdate'(){
            console.log(this.data.birthdate)
        }

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
          this.firstForm = false
          this.secondForm = true
        }
      )
    },
    verifyCode(){
      var params = {
        code: this.code
      }

      this.$axios.get("/verify-code", params).then(response=>{
        if(response.data.verified){
          this.secondForm = false
          this.thirdForm = true
        }
      })
    },
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