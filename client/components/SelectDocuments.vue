<template>
    <div class="pt-20 px-20 pb-8">
        <h1>Select type of document you would like to request</h1>
        <p>You can choose more than one document request at a time</p><br>
        <div class="rounded-2xl bg-white py-8 px-16">
            <div v-for="doc in documents" :key="doc.id" class="flex items-center space-x-2">
                <input type="radio" :id="doc.id" :name="doc.name" v-model="selectedRequest" :value="doc" class="w-fit">
                <label :for="doc.name" class="font-bold text-slate-600">{{doc.name}}</label><br><br>
            </div><br>
            <p class="error">{{error}}</p>
        </div>
        <Spin v-if="spinning"/>
    </div>
</template>

<script>
export default {
    props:["error"],
    data(){
        return{
            selectedRequest:"",
            documents:[],
            spinning:false,
        }
    },
    mounted(){
        this.getDocuments()
    },
    watch:{
        selectedRequest(){
            this.$store.commit('request/updateSelectedDocuments', {
                selectedDocument: this.selectedRequest,
            });
        }
    },
    methods:{
        async getDocuments(){
            this.spinning = true
            await this.$axios.get('/user/request/documents').then(response=>{
                this.documents = response.data
                this.spinning = false
            }).catch(err=>{
                this.spinning = false
            })
        }
    }

}
</script>

<style scoped>
/* input[type=checkbox]{
    accent-color: yellow;
    @apply w-8 h-8 
}
input[type=checkbox]:after{
    border: solid white;
} */
h1{
  @apply text-3xl font-bold
}
input[type='radio'] { 
     transform: scale(1.5); 
 }

</style>