<template>
    <div class="bg-slate-100 min-h-screen pb-20 text-black">
        <SelectDocuments :error="errorPageOne" v-if="page==1"/>
        <RequestForm :error="errorPageTwo" v-if="page==2"/>
        <PickUpSchedule :error="errorPageThree" v-if="page==3"/>
        <ReviewRequest v-if="page==4"/>
        <div class="m-auto mt-4 space-x-4 w-fit">
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page==1">Cancel</button>
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page>1" @click="page--">Back</button>
            <button class="bg-yellow-400 text-white px-20 py-2 rounded-lg" v-if="page<4" @click="nextPage" >Next</button>
            <button class="bg-yellow-400 text-white px-20 py-2 rounded-lg" v-if="page==4" @click="submitRequest">Save</button>
        </div>
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
            errorPageThree:""
        }
    },
    methods:{
        nextPage(){
            if(this.page==1){
                let selectedDocuments = this.$store.state.request.request.selectedDocuments
                if(!selectedDocuments || selectedDocuments.length<1){
                    this.errorPageOne="Please select alteast one document to request"
                }
                else{
                    this.errorPageOne = ""
                    this.page++
                }
            }
            else if(this.page==2){
                let form = this.$store.state.request.request.form
                if(!form.purpose || !form.validID){
                    this.errorPageTwo="Please fill up the the missing fields"
                }
                else{
                    this.errorPageTwo = ""
                    this.page++
                }
            }
            else if(this.page==3){
                let pickUpDate = this.$store.state.request.request.pickUpDate
                if(!pickUpDate){
                    this.errorPageThree="Please select a date"
                }
                else{
                    this.errorPageThree = ""
                    this.page++
                }
            }
        },
        async submitRequest(){
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            await this.$axios.post('/user/submit-request', this.$store.state.request.request)
        }
    }
}
</script>

<style scoped>


</style>