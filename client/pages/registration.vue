<template>
    <div class="registration-container">
        <div class="form-wrapper m-auto">
            <h1 class="text-center text-2xl">eDokumento</h1><br>
            <form>
                <p class="text-center">Step 1 of 2</p><br><br><br>
                <input type="text" id="firstname" name="firstname" placeholder="First Name" required><br><br>
                <input type="text" id="middlename" name="middlename" placeholder="Middle Name" required><br><br>
                <input type="text" id="lastname" name="lastname" placeholder="Last Name" required><br><br>
                <div class="select-container" required>
                    <select id="gender" name="gender" placeholder="Gender">
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
                <input type="date" class="w-full"><br><br>
                <label>Mother's Maiden Name</label>
                <div class="input-container">
                    <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
                    <input type="text" id="firstname" name="firstname" placeholder="Middle Name" required>
                    <input type="text" id="firstname" name="firstname" placeholder="Laste Name" required>
                </div>
                <div class="button-wrapper text-center">
                    <button class="py-4 bg-sky-900 rounded-full w-96 m-auto font-bold text-white text-2xl">Next</button>
                </div>
            </form><br>
            
    </div>
</div>
  
</template>

<script lang="ts">
export default {

}
</script>

<style>

</style>