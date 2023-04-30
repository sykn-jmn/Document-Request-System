<template>
    <div class="md:pt-20 md:px-20 md:pb-4">
        <h1 class="text-3xl font-bold">Complete the Request Form</h1>
        <p class="font-medium">Make sure to not leave any field blank</p><br>
        <form>
            <div class="detail-container col-span-2">
                <p class="label">Full Name<span class="guide"> (First Name M.I. Last Name)</span></p>
                <div class="box">
                    {{data.first_name + " " + data.middle_initial + ". " + data.last_name}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Age</p>
                <div class="box">
                    {{getAge(data.birthdate)}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Birthdate <span class="guide">(yyyy-mm-dd)</span></p>
                <div class="box">
                    {{data.birthdate}}
                </div>
            </div>
            <div class="detail-container col-span-2">
                <p class="label">Complete Address<span class="guide"> (Street/Purok, Baranggay, City/Municipality, Province)</span></p>
                <div class="box">
                    {{data.purok + " " + data.baranggay + " " + data.municipality + " " + data.province}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Email</p>
                <div class="box">
                    {{data.email}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Mobile Number</p>
                <div class="box">
                    {{data.mobile_number}}
                </div>
            </div>
            <label class="col-span-2">
                Purpose of Request
                <textarea class="mt-4" v-model="purposeOfRequest"></textarea>
            </label>
            <div class="detail-container col-span-2">
                <p class="label">Supporting Documents</p>
                <span class="guide">Upload photo/scanned copy of your supporting documents.</span>
            </div>
            <label class="col-span-2">
                Valid ID <span class="guide">(Valid types are <b>jpg</b> and <b>png</b>)</span>
                <input type="file" v-on:change="onChangeID" accept="image/jpeg, image/png">
            </label>
            <label class="col-span-2">
                Other Supporting Documents <span class="guide">(Valid types are <b>jpg</b>, <b>png</b>, and <b>pdf</b>)</span>
                <input type="file" v-on:change="onChangeDocuments" accept="image/jpeg, image/png, application/pdf" multiple required>
            </label>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            data:'',
            purposeOfRequest:'',
            validID:'',
            supportingDocument:'',
        }
    },
    mounted(){
        this.getUser()
    },
    methods:{
        async getUser(){
            await this.$axios.get('/user/get-details').then(response=>{
                this.data = response.data
                this.data.middle_initial = response.data.middle_name[0]
                this.$store.commit('request/updateRequestForm', {
                    requestForm: this.data,
                });
            })
        },
        getAge(birthdate){

                var today = new Date();
                var birthDate = new Date(birthdate);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;

        },
        onChangeID(e){
            this.$store.commit('request/updateValidID', {
                validID: e.target.files[0],
            });
        },
        onChangeDocuments(e){
            this.$store.commit('request/updateSupportingDocuments', {
                supportingDocuments: e.target.files,
            });
        }
    }

}
</script>

<style scoped>
.label, label{
    @apply font-semibold text-xl mb-4
}
.guide{
    @apply text-slate-400 font-normal text-xl
}
.box{
    @apply py-2 px-4 border border-black rounded-lg mt-4 text-xl
}
form{
    @apply grid grid-cols-2 gap-4 bg-white p-8 md:rounded-xl
}
.detail-container{
    @apply mb-4
}

</style>