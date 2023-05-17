<template>
  <div class="min-h-screen flex flex-col pt-24 justify-between">
    <h1 class="text-center text-3xl">{{appName}}</h1>

    <form @submit.prevent="submitEmail" class="forgotPasswordForm" v-if="firstForm">
      <h2 class="text-sky-900 font-black text-2xl mt-16 text-center">Forgot Your Password?</h2><br>
      <p>Enter the email associated with your account to change the password.</p><br>
      <input type="email" v-model="email" placeholder="Email">
      <p class="error" v-if="errorEmail">{{errorEmail}}</p>
      <div class="button-wrapper text-center">
        <button class="">Next</button>
      </div><br>
      <div class="flex space-x-4 text-blue-500 text-base items-center m-auto w-fit cursor-pointer" @click="$router.push('/')">
        <font-awesome-icon :icon="['fas', 'chevron-left']" />
        <p to="/">Back to Login</p>
      </div>
    </form>

    <form @submit.prevent="verifyCode" class="forgotPasswordForm" v-if="secondForm">
      <div class="flex justify-between items-center">
        <div class="flex space-x-4 text-blue-500 text-base items-center w-fit cursor-pointer" @click="backToFirst">
          <font-awesome-icon :icon="['fas', 'chevron-left']" />
          <p to="/">Back</p>
        </div>
        <div class="w-fit cursor-pointer" @click="$router.push('/')">
          <font-awesome-icon :icon="['fas', 'xmark']" class="x-mark" />
        </div>
      </div>
      <h2 class="text-sky-900 font-black text-2xl text-center mt-16">Code Verification</h2><br>
      <p class="text-center">Enter 4-digit verification code sent to {{email}}</p><br>
      <input type="text" v-model="code" class="text-center">
      <p class="error" v-if="errorCode">{{errorCode}}</p>
      <div class="button-wrapper text-center">
        <button class="">Verify Code</button>
     </div><br>
     <p class="text-sky-900 hover:text-sky-500 text-center text-lg font-bold cursor-pointer" @click="resendCode">Resend Code</p>
    </form>

    <form @submit.prevent="submitNewPassword" class="forgotPasswordForm" v-if="thirdForm">
      <div class="flex justify-between items-center">
        <div class="flex space-x-4 text-blue-500 text-base items-center w-fit cursor-pointer" @click="backToSecond">
          <font-awesome-icon :icon="['fas', 'chevron-left']" />
          <p to="/">Back</p>
        </div>
        <div class="w-fit cursor-pointer" @click="$router.push('/')">
          <font-awesome-icon :icon="['fas', 'xmark']" class="x-mark" />
        </div>
      </div>
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
        <button class="">Update</button>
     </div>
    </form>

    <form @submit.prevent="" class="forgotPasswordForm" v-if="isPasswordChanged">
      <h2 class="text-sky-900 font-black text-2xl text-center">Password Updated</h2><br>
      <div class="icon-container">
        <font-awesome-icon :icon="['fas', 'circle-check']" />
      </div><br>
      <p class="text-center">Your password has been updated!</p><br>
      <div class="button-wrapper text-center">
        <NuxtLink to="/"><button class="">Login</button></NuxtLink>
     </div>
    </form>
    <AppFooter />
    <Spin v-if="spinning"/>
  </div>
</template>

<script>
export default {
  data(){
    return{
      spinning:false,
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
    backToFirst(){
      this.firstForm=true
      this.secondForm = false
    },
    backToSecond(){
      this.secondForm=true
      this.thirdForm = false
    },
    submitEmail(){
      this.sendEmailCode()
    
    },
    async verifyCode(){
      this.spinning = true
      var params = {
        code: this.code,
        userId: this.userId
      }

      await this.$axios.get("/user/verify-code-password", {params}).then(response=>{
        if(response.data.isVerified){
          this.secondForm = false
          this.thirdForm = true
        }
        this.spinning = false
      })
    },
    resendCode(){
      this.sendEmailCode()
    },
    async sendEmailCode(){
      this.spinning = true
      var params = {
        email: this.email
      }
      await this.$axios.get("/user/send-code/", {params}).then(response=>{
          if(!response.data.isEmailExist){
            this.errorEmail = "Email address does not exist in the record"
          }else{
              this.userId = response.data.user_id;
              this.firstForm = false
              this.secondForm = true
          }
          this.spinning = false

        }
      )
    },
    async submitNewPassword(){
      //verify password
      this.spinning = true
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
                  this.spinning = false
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
  @apply bg-white p-8 pb-16 text-slate-600 m-auto rounded-2xl mt-8 relative
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
  @apply w-fit text-green-500
}
button{
  @apply py-2 bg-red-600 rounded-lg px-24 m-auto font-bold text-white text-xl shadow-xl
}
.x-mark{
  @apply text-blue-500 text-lg
}

</style>