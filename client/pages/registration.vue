<template>
    <div class="registration-container">
        <h1 class="text-center text-2xl">eDokumento</h1><br>
        <div class="form-wrapper m-auto" v-if="!data.nextForm">
            <form>
                <div class="form-container">
                    <p class="text-center">Step 1 of 2</p><br><br><br>
                    <input type="text" id="firstname" name="firstname" placeholder="First Name" required><br><br>
                    <input type="text" id="middlename" name="middlename" placeholder="Middle Name" required><br><br>
                    <input type="text" id="lastname" name="lastname" placeholder="Last Name" required><br><br>
                    <div class="select-container">
                        <select id="gender" name="gender" placeholder="Gender" required>
                            <option value="" disabled selected hidden>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="non-binary">Non-binary</option>
                            <option value="others">Not to mention</option>
                        </select>
                        <select id="civil_status" name="civil_Status" placeholder="Civil Status" required>
                            <option value="" disabled selected hidden>Civil Status</option>
                            <option value="single">Single</option>
                            <option value="non-binary">Married</option>
                        </select>
                    </div><br>
                    <label>Birthdate</label>
                    <input type="date" class="w-full" required><br><br>
                    <label>Mother's Maiden Name</label>
                    <div class="input-container">
                        <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
                        <input type="text" id="middlename" name="middlename" placeholder="Middle Name" required>
                        <input type="text" id="lastname" name="lasttname" placeholder="Last Name" required>
                    </div>    
                </div><br>
                <div class="button-wrapper text-center">
                    <button class="py-4 bg-sky-900 rounded-full w-96 m-auto font-bold text-white text-2xl shadow-xl" @click="data.nextForm = !data.nextForm">Next</button>
                </div>
            </form><br>
        </div>
        <div class="form-wrapper m-auto" v-else>
            <form>
                <div class="form-container">
                    <p class="text-center">Step 2 of 2</p><br><br><br>
                    <input type="number" id="phone_number" name="phone_number" placeholder="Mobile Number (09XXXXXXXXX)" min="11" required><br><br>
                    <input type="email" id="email" name="email" placeholder="Email Address" required><br><br>
                    <div class="input-container">
                        <div class="password-container">
                            <input class="border-none" :type="data.passwordFieldType " id="password" name="password" placeholder="Enter Password" required><font-awesome-icon :icon="['fas', data.eyeIconType]" class="eyeIcon" @click="showPassword = !showPassword"/>
                        </div><br><br>
                        <div class="password-container" >
                            <input class="border-none" :type="data.confirmPasswordFieldType" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><font-awesome-icon :icon="['fas', data.confirmEyeIconType]" class="eyeIcon" @click="showConfirmPassword = !showConfirmPassword"/>
                        </div>
                    </div>    
                </div><br>
                <div class="button-wrapper text-center">
                    <button class="py-4 bg-sky-900 rounded-full w-96 m-auto font-bold text-white text-2xl shadow-xl">Next</button>
                </div>
            </form><br>
        </div>
    </div>
  
</template>

<script lang="ts">
import { reactive, watch, ref} from 'vue'
export default {
    setup(){
        const runtimeConfig = useRuntimeConfig()
        const data = reactive({
            nextForm:false,
            passwordFieldType:"password",
            confirmPasswordFieldType:"password",
            eyeIconType:"eye-slash",
            confirmEyeIconType:"eye-slash",
            appName: runtimeConfig.appName,
        })

        const showPassword = ref(false);
        const showConfirmPassword = ref(false);

        watch(showPassword , (prev, newvalue) => {
            if(showPassword.value){
                data.passwordFieldType = "text"
                data.eyeIconType = "eye"
            }else{
                data.passwordFieldType = "password"
                data.eyeIconType = "eye-slash"
            }
            
 
        });

        watch(showConfirmPassword , (prev, newvalue) => {
            if(showConfirmPassword.value){
                data.confirmPasswordFieldType = "text"
                data.confirmEyeIconType = "eye"
            }else{
                data.confirmPasswordFieldType = "password"
                data.confirmEyeIconType = "eye-slash"
            }
 
        });

        

        return {data, showPassword, showConfirmPassword}
    }
}
</script>

<style>

</style>