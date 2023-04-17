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
    <form @submit.prevent="verifyCode" class="forgotPasswordForm" v-if="secondForm">
      <h2 class="text-sky-900 font-black text-2xl text-center">Code Verification</h2><br>
      <p class="text-center">Enter 4-digit verification code sent to {{email}}</p><br>
      <input type="text" v-model="code" class="mt-8">
      <p class="error" v-if="errorCode">{{errorCode}}</p>
      <div class="button-wrapper text-center">
        <button class="py-4 bg-yellow-500 rounded-full w-80 m-auto font-bold text-white text-2xl shadow-xl">Verify Code</button>
     </div><br>
     <p class="text-sky-900 hover:text-sky-500 text-center text-lg font-bold cursor-pointer" @click="resendCode">Resend Code</p>
    </form>
    <form @submit.prevent="submitNewPassword" class="forgotPasswordForm" v-if="thirdForm">
      <h2 class="text-sky-900 font-black text-2xl text-center">Create New Password</h2><br>
      <p>Make sure your new password is 8 characters or more. Try including numbers, letters, &amp; punctuation marks for a strong password</p><br>
      <div class="password-container">
          <input class="border-none" :type="passwordFieldType" id="password" name="password" v-model="password" placeholder="Enter Password" required><font-awesome-icon :icon="['fas', eyeIconType]" class="eyeIcon" @click="showPassword = !showPassword"/>
      </div><br>
      <div class="password-container" >
          <input class="border-none" :type="confirmPasswordFieldType" id="confirm_password" v-model="confirmPassword" name="confirm_password" placeholder="Confirm Password" required><font-awesome-icon :icon="['fas', confirmEyeIconType]" class="eyeIcon" @click="showConfirmPassword = !showConfirmPassword"/>
      </div>
      <p class="error">{{errorPass}}</p>
      <div class="button-wrapper text-center">
        <button class="py-4 bg-yellow-500 rounded-full w-80 m-auto font-bold text-white text-2xl shadow-xl">Update</button>
     </div>
    </form>
    <form @submit.prevent="" class="forgotPasswordForm" v-if="isPasswordChanged">
      <h2 class="text-sky-900 font-black text-2xl text-center">Password Updated</h2><br>
      <div class="icon-container">
        <font-awesome-icon :icon="['fas', 'circle-check']" class="test" />
      </div>
      <p class="text-center">Your password has been updated!</p><br>
      <div class="button-wrapper text-center">
        <NuxtLink to="/"><button class="py-4 bg-yellow-500 rounded-full w-80 m-auto font-bold text-white text-2xl shadow-xl">Login</button></NuxtLink>
     </div>
    </form>
    <AppFooter />
  </div>
</template>

<script>
export default {
  data(){
    return{
      email:"",
      errorEmail:"",
      errorCode:"",
      errorPass:"",
      code:"",
      firstForm:true,
      secondForm:false,
      thirdForm:false,
      isPasswordChanged:false,
      passwordFieldType:"password",
      confirmPasswordFieldType:"password",
      eyeIconType:"eye-slash",
      confirmEyeIconType:"eye-slash",
      showPassword:false,
      showConfirmPassword:false,
      confirmPassword:'',
      password:'',
      userId:'',
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
            if(this.password != this.confirmPassword){
                this.errorPass = "Inconsistent password!"
            }else{
                this.errorPass = ""
            }
        },
    },
  methods:{
    submitEmail(){
      this.sendEmailCode()
    
    },
    async verifyCode(){
      var params = {
        code: this.code,
        userId: this.userId
      }

      await this.$axios.get("/user/verify-code-password", {params}).then(response=>{
        if(response.data.isVerified){
          this.secondForm = false
          this.thirdForm = true
        }
      })
    },
    resendCode(){
      this.sendEmailCode()
    },
    async sendEmailCode(){
      var params = {
        email: this.email
      }
      await this.$axios.get("/user/send-code/", {params}).then(response=>{
          if(!response.data.isEmailExist){
            this.errorEmail = "Email address does not exist in the record"
          }
          this.userId = response.data.user_id;
          this.firstForm = false
          this.secondForm = true
        }
      )
    },
    async submitNewPassword(){
      //verify password
      if(this.password != this.confirmPassword){
          this.errorPass = "Inconsistent password!"
          this.isPasswordChanged = false
      }
      else{
          this.errorPass = ""
          var params = {
            newPassword: this.password,
            userId: this.userId,
          }
          await this.$axios.put('/user/update-password', params).then(response =>{
                  if(response.data.isUpdated){
                      this.thirdForm = false
                      this.isPasswordChanged = true
                  }
              }
          )
      }
    }
  }
}
</script>

<style scoped>
.forgotPasswordForm{
  width: 500px;
  @apply bg-white px-8 pt-32 pb-16 text-slate-600 m-auto rounded-2xl mt-8
}
h1{
  @apply mt-24
}

.password-container{
  @apply w-full m-auto
}
.password-container >input{
  @apply w-full
}
.icon-container{
  font-size:100px;
  margin:auto;
  color: rgb(30,48,80);
  @apply w-fit
}

</style>