<template>
    <div class="registration-container">
        <h1 class="text-center text-2xl">{{appName}}</h1><br>
        <div class="form-wrapper m-auto"  @submit.prevent="submitFirstForm" v-if="firstForm">
            <form>
                <div class="form-container">
                    <p class="text-center">Step 1 of 2</p><br><br><br>
                    <input type="text" id="firstname" name="firstname" v-model="data.first_name" placeholder="First Name" required><br><br>
                    <input type="text" id="middlename" name="middlename" v-model="data.middle_name" placeholder="Middle Name" required><br><br>
                    <input type="text" id="lastname" name="lastname" v-model="data.last_name" placeholder="Last Name" required><br><br>
                    <div class="select-container">
                        <select id="sex" name="sex" v-model="data.sex" placeholder="Sex" required>
                            <option value="" disabled selected hidden>Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <select id="civil_status" name="civil_Status" placeholder="Civil Status" v-model="data.civil_status" required>
                            <option value="" disabled selected hidden>Civil Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                        </select>
                    </div><br>
                    <label>Birthdate</label>
                    <input type="date" v-model="data.birthdate" class="w-full" required><br><br>
                    <label>Mother's Maiden Name</label>
                    <div class="input-container">
                        <input type="text" id="firstname" name="firstname" v-model="data.mothers_firstname" placeholder="First Name" required>
                        <input type="text" id="middlename" name="middlename" v-model="data.mothers_middlename" placeholder="Middle Name" required>
                        <input type="text" id="lastname" name="lasttname" v-model="data.mothers_lastname" placeholder="Last Name" required>
                    </div>    
                </div><br>
                <div class="button-wrapper text-center">
                    <button class="py-4 bg-sky-900 rounded-full w-96 m-auto font-bold text-white text-2xl shadow-xl">Next</button>
                </div>
            </form><br>
        </div>
        <div class="form-wrapper m-auto" v-if="secondForm">
            <form @submit.prevent="submitSecondForm">
                <div class="form-container">
                    <p class="text-center">Step 2 of 2</p><br><br><br>
                    <input type="tel" id="phone_number" name="phone_number" v-model="data.mobile_number" placeholder="Mobile Number (09XXXXXXXXX)" min="11" pattern="[0-9]{11}" required><br><br>
                    <input type="email" id="email" name="email" v-model="data.email" placeholder="Email Address" required><br><br>
                    <div class="input-container">
                        <div class="password-container">
                            <input class="border-none" :type="passwordFieldType" id="password" name="password" v-model="data.password" placeholder="Enter Password" required><font-awesome-icon :icon="['fas', eyeIconType]" class="eyeIcon" @click="showPassword = !showPassword"/>
                        </div><br><br>
                        <div class="password-container" >
                            <input class="border-none" :type="confirmPasswordFieldType" id="confirm_password" v-model="confirmPassword" name="confirm_password" placeholder="Confirm Password" required><font-awesome-icon :icon="['fas', confirmEyeIconType]" class="eyeIcon" @click="showConfirmPassword = !showConfirmPassword"/>
                        </div>
                    </div>
                    <br>
                    <span class="h-16">
                        <p class="text-red-500 text-center">{{error}}</p>
                    </span>    
                </div><br>
                <div class="button-wrapper text-center">
                    <button class="py-4 bg-sky-900 rounded-full w-96 m-auto font-bold text-white text-2xl shadow-xl">Next</button>
                </div>
            </form><br>
        </div>
        <div v-if="isAccountCreated" class="w-fit m-auto">
            <div class="messageContainer">
                <h2>Account created successfully!</h2>
            </div><br>
            <p class="text-center text-base">Please check your email for verification</p>
        </div>
    </div>
  
</template>

<script>
export default {
    data(){
        return{
            isNextForm:false,
            passwordFieldType:"password",
            confirmPasswordFieldType:"password",
            eyeIconType:"eye-slash",
            confirmEyeIconType:"eye-slash",
            showPassword:false,
            showConfirmPassword:false,
            confirmPassword:'',
            error:'',
            errorEmail:'',
            isAccountCreated:false,
            firstForm:true,
            secondForm:false,
            data:{
                first_name:'',
                middle_name:'',
                last_name:'',
                email:'',
                sex:'',
                civil_status:'',
                birthdate:'',
                mothers_firstname:'',
                mothers_middlename:'',
                mothers_lastname:'',
                password:'',
            }

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
        submitFirstForm(){
            this.firstForm= false
            this.secondForm= true
        },
        submitSecondForm(){
            //check email if its already existing
            var params = {
                email: this.data.email
            }
            this.$axios.get('/user/check-email',params).then(response=>{
                if(response.data.isEmailExist){
                    this.errorEmail = "This email is already taken."
                    this.isAccountCreated = false
                }
            })

            //verify password
            if(this.data.password != this.confirmPassword){
                this.error = "Inconsistent password!"
                this.isAccountCreated = false
            }
            else{
                this.error = ""
                let params = this.data
                this.$axios.post('/user/store', params).then(response =>{
                        if(response.data.isAccountCreated){
                            this.secondForm = false
                            this.isAccountCreated = true
                        }
                    }
                )
            }

        }
        
    }
}
</script>

<style>
.messageContainer{
    @apply m-auto bg-green-500 w-fit p-8 rounded-xl
}
.messageContainer > h2{
    @apply text-2xl text-center
}



</style>