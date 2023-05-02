<template>
    <div class="md:pt-20 md:px-20 md:pb-4">
        <h1>Complete the Request Form</h1>
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
                    {{data.purok + ", " + data.baranggay + ", " + data.municipality + ", " + data.province}}
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
                <input type="file" v-on:change="onChangeDocuments" accept="image/jpeg, image/png, application/pdf" ref="file" multiple required>
            </label>
            <p class="error">{{error}}</p>
        </form>
    </div>
</template>

<script>

export default {
    props:["error"],
    data(){
        return{
            data:'',
            purposeOfRequest:'',
            validID:'',
            supportingDocuments:'',
        }
    },
    mounted(){
        this.getUser()
    },
    watch:{
        purposeOfRequest(){
            this.$store.commit('request/updatePurposeOfRequest', {
                purpose:this.purposeOfRequest
            });
        },
        '$store.state.request.request.form.validIDName':function(newValue){
            console.log(newValue)
        },
        '$store.state.request.request.form.purpose'(){
            console.log("hi")
        }
    },
    methods:{
        async getUser(){
            await this.$axios.get('/user/get-details').then(response=>{
                this.data = response.data
                this.data.middle_initial = response.data.middle_name[0]
                this.$store.commit('request/updateRequestForm', {
                    requestForm: {
                        name: this.data.first_name + " " + this.data.middle_initial + ". " + this.data.last_name,
                        age: this.getAge(this.data.birthdate),
                        birthdate: this.data.birthdate,
                        address: this.data.purok + ", " + this.data.baranggay + ", " + this.data.municipality + ", " + this.data.province,
                        email:this.data.email,
                        mobile_number:this.data.mobile_number,
                        sex:this.data.sex,
                        civil_status: this.data.civil_status
                    },
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
            this.validID = e.target.files[0]
            let data = new FormData()
            data.append('file', this.validID);
            this.$store.commit('request/updateValidID', {
                validID: data,
                validIDName:this.validID.name
            });
            
        },
        onChangeDocuments(e){
            let data = new FormData()
            this.supportingDocuments = e.target.files
            for(let i =0; i<this.$refs.file.files.length; i++ ){
                let file = this.$refs.file.files[i];
                data.append('files[' + i + ']', file);
            }

            let supportingDocumentsName = []
            Object.keys(this.supportingDocuments).forEach((key, index) =>
                {
                    let name = this.supportingDocuments[key].name;
                    supportingDocumentsName.push(name)
                });
            this.$store.commit('request/updateSupportingDocuments', {
                supportingDocuments: data,
                supportingDocumentsName: supportingDocumentsName
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