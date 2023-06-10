<template>
    <div class="bg-slate-100 min-h-screen pb-20 text-black">
        <SelectDocuments :error="errorPageOne" v-if="page==1"/>
        <RequestForm :error="errorPageTwo" v-if="page==2"/>
        <PickUpSchedule :error="errorPageThree" v-if="page==3"/>
        <ReviewRequest v-if="page==4"/>
        <RequestSaveSuccessful v-if="page==5"/>
        <div class="m-auto mt-4 space-x-4 w-fit">
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page==1">Cancel</button>
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page>1 && page<=4" @click="page--">Back</button>
            <button class="bg-yellow-400 text-white px-20 py-2 rounded-lg" v-if="page<4" @click="nextPage" >Next</button>
            <button class="bg-yellow-400 text-white px-20 py-2 rounded-lg" v-if="page==4" @click="submitRequest">Save</button>
        </div>
        <div class="w-fit m-auto">
            <button class="bg-yellow-400 text-white text-3xl px-24 py-2 text-center rounded-3xl" v-if="page==5" @click="done">Done</button>
        </div>
        <Spin v-if="spinning"/>
    </div>
</template>

<script>
export default {
    layout: 'user',
    data(){
        return{
            page:1,
            buttonStatus: "isButtonDisabled",
            errorPageOne:"",
            errorPageTwo:"",
            errorPageThree:"",
            spinning:false,
        }
    },
    mounted(){
            this.$store.commit('request/updateFormData', {
                formData: new FormData(),
            });
    },
    methods:{
        nextPage(){
            if(this.page==1){
                let selectedDocument = this.$store.state.request.selectedDocument
                if(!selectedDocument){
                    this.errorPageOne="Please select alteast one document to request"
                }
                else{
                    this.errorPageOne = ""
                    this.page++
                }
            }
            else if(this.page==2){
                let form = this.$store.state.request
                if(!form.purpose || !form.validIDName){
                    this.errorPageTwo="Please fill up the the missing fields"
                }
                else{
                    this.errorPageTwo = ""
                    this.page++
                }
            }
            else if(this.page==3){
                let pickUpDate = this.$store.state.request
                if(!pickUpDate.selectedDate || !pickUpDate.meridiem){
                    this.errorPageThree="Please select a date"
                }
                else{
                    this.errorPageThree = ""
                    this.page++
                }
            }
        },
        async submitRequest(){
            this.spinning = true
            await this.$axios.post('/user/request/submit-request', this.$store.state.request.formData).then(response=>{
                this.page++
                this.spinning = false
            }).catch(err=>{
                console.log(err)
                this.spinning = false
            })
        },
        done(){
            this.page = 1
        }
    }
}
</script>

<style scoped>
h1{
  @apply text-3xl font-bold
}

</style>