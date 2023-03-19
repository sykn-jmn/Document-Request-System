<template>
    <div class="registration-container">
        <div class="form-wrapper m-auto bg-black">
            <h1 class="text-center text-2xl">eDokumento</h1><br>
            <form>
                <p class="text-center">Step 1 of 2</p><br><br><br>
                <input type="text" id="firstname" name="firstname" placeholder="First Name"><br><br>
                <input type="text" id="middlename" name="middlename" placeholder="Middle Name"><br><br>
                <input type="text" id="lastname" name="lastname" placeholder="Last Name"><br><br>
                <div class="select-container">
                    <select id="gender" name="gender" placeholder="Gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="others">Not to mention</option>
                    </select><br><br>
                    <select id="civil_status" name="civil_Status" placeholder="Civil Status">
                        <option value="single">Single</option>
                        <option value="non-binary">Married</option>
                    </select>
                </div>
            </form>
    </div>
</div>
  
</template>

<script lang="ts">
export default {

}
</script>

<style>

</style>