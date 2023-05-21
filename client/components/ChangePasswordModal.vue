<template>
  <div class="modal">
    <form class="change-password-form">
        <h1>Change Password</h1><br>
        <div class="border-t border-slate-400 p-4">
            <label>Current Password</label>
            <div class="password-container">
                <input class="border-none" :type="currPasswordFieldType" id="password" name="password" v-model="currPassword"  min="8" required><font-awesome-icon :icon="['fas', currEyeIconType]" class="eyeIcon" @click="showCurrPassword = !showCurrPassword"/>
            </div><br>
            <label>New Password</label>
            <div class="password-container">
                <input class="border-none" :type="passwordFieldType" id="password" name="password" v-model="newPassword"  min="8" required><font-awesome-icon :icon="['fas', eyeIconType]" class="eyeIcon" @click="showNewPassword = !showNewPassword"/>
            </div><br>
            <label>Confirm New Password</label>
            <div class="password-container" >
                <input class="border-none" :type="confirmPasswordFieldType" id="confirm_password" v-model="confirmPassword" name="confirm_password" min="8"  required><font-awesome-icon :icon="['fas', confirmEyeIconType]" class="eyeIcon" @click="showConfirmPassword = !showConfirmPassword"/>
            </div>
        </div><br>
        <div class="md:flex m-auto w-fit space-x-2">
            <button class="w-fit bg-slate-300 px-16 py-1 rounded-md" @click="$emit('close')">Back</button>
            <button class="w-fit bg-red-500 px-16 py-1 rounded-md text-white" @click="submit">Submit</button>
        </div>
    </form>
  </div>
</template>

<script>
export default {
    data(){
        return{
            currPassword:'',
            newPassword:'',
            confirmPassword:'',

            currPasswordFieldType:"password",
            passwordFieldType:"password",
            confirmPasswordFieldType:"password",

            currEyeIconType:"eye-slash",
            eyeIconType:"eye-slash",
            confirmEyeIconType:"eye-slash",

            showCurrPassword:false,
            showNewPassword:false,
            showConfirmPassword:false,
        }
    },
     watch:{
        showCurrPassword(){
            if(this.showCurrPassword){
                this.currPasswordFieldType = "text"
                this.currEyeIconType = "eye"
            }else{
                this.currPasswordFieldType = "password"
                this.currEyeIconType = "eye-slash"
            }
        },
        showNewPassword(){
            if(this.showNewPassword){
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
     },
     methods:{
        updatePassword(){

        }
     }
}
</script>

<style scoped>
h1{
    @apply text-left
}
label{
    @apply font-semibold
}
button{
    @apply font-semibold
}


</style>