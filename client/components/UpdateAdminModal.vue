<template>
    <div class="modal">
        <div class="update-modal">
            <h1>REVIEW CHANGES BEFORE SAVING </h1><br>
            <div class="flex items-center justify-around">
                <hr>
                <h2>USER INFORMATION</h2>
                <hr>
            </div>
            <div class="info-box">
                <p>First Name:</p>
                <p class="font-semibold col-span-2">{{data.first_name}}</p>
                <p>Middle Name:</p>
                <p class="font-semibold col-span-2">{{data.middle_name}}</p>
                <p>Last Name:</p>
                <p class="font-semibold col-span-2">{{data.last_name}}</p>
                <p>Suffix:</p>
                <p class="font-semibold col-span-2">{{data.suffix?data.suffix:"N/A"}}</p>
                <p>Sex/Gender:</p>
                <p class="font-semibold col-span-2">{{capitalize(data.sex)}}</p>
                <p>Civil Status:</p>
                <p class="font-semibold col-span-2">{{capitalize(data.civil_status)}}</p>
                <p>Birthdate:</p>
                <p class="font-semibold col-span-2">{{data.birthdate}}</p>
                <p>Birthplace:</p>
                <p class="font-semibold col-span-2">{{data.birthplace}}</p>
                <p>Religion:</p>
                <p class="font-semibold col-span-2">{{data.religion}}</p>
                <p>Citizenship:</p>
                <p class="font-semibold col-span-2">{{data.citizenship}}</p>
                <p>Address:</p>
                <p class="font-semibold col-span-2">{{data.purok}}, {{data.barangay}}, {{data.municipality}}, {{data.province}}</p>
                <p>Zip Code:</p>
                <p class="font-semibold col-span-2">{{data.zip_code}}</p>
            </div>
            <div class="flex items-center justify-around">
                <hr>
                <h2>CONTACT DETAILS</h2>
                <hr>
            </div>
            <div class="info-box">
                <p>Mobile Number:</p>
                <p class="font-semibold col-span-2">{{data.mobile_number}}</p>
                <p>Email:</p>
                <p class="font-semibold col-span-2">{{data.email}}</p>
            </div>
            <div class="flex items-center justify-around">
                <hr>
                <h2>OTHER INFORMATION</h2>
                <hr>
            </div>
            <div class="info-box">
                <p>Mother's Maiden Name:</p>
                <p class="font-semibold col-span-2">{{data.mothers_firstname}} {{data.mothers_middlename}} {{data.mothers_lastname}}</p>
            </div>
            <div class="md:flex m-auto w-fit space-x-2">
                <button class="w-fit bg-slate-300 px-16 py-1 rounded-md" @click="$emit('close')">Back</button>
                <button class="w-fit bg-red-500 px-16 py-1 rounded-md text-white" @click="submit">Submit</button>
            </div>
        </div>
        <Spin v-if="spinning"/>
    </div>
</template>

<script>
export default {
    emits:['close'],
    props:['data'],
    data(){
        return{
            spinning:false
        }
    },
    methods:{
        capitalize(word){
            return word.charAt(0).toUpperCase() + word.slice(1)
        },
        async submit(){
            this.spinning = true
            await this.$axios.put('/admin/account/update-user', this.data).then(response=>{
                this.spinning = false
                this.$emit('close')
            }).catch(err=>{
                this.spinning = false
                this.$emit('close')
            })
        }
    }
}
</script>

<style scoped>
hr{
  @apply w-2/5 text-black
}
h2{
  @apply text-center
}
.info-box{
  @apply grid grid-cols-3 pt-8 pb-8 w-3/5 text-base m-auto
}
.update-modal{
    @apply p-8 rounded-xl bg-white m-auto md:w-3/5
}
H1{
    @apply font-bold text-xl
}

</style>