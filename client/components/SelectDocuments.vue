<template>
    <div class="pt-20 px-20 pb-8">
        <h1 class="text-3xl font-bold">Select type of document you would like to request</h1>
        <p>You can choose more than one document request at a time</p><br>
        <div class="rounded-2xl bg-white py-8 px-16">
            <div v-for="doc in documents" :key="doc.id" class="flex items-center space-x-2">
                <input type="checkbox" :id="doc.id" :name="doc.name" v-model="selectedRequest" :value="doc.id" class="w-fit">
                <label :for="doc.name" class="font-bold text-slate-600">{{doc.name}}</label><br><br>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            selectedRequest:[],
            documents:[]
        }
    },
    mounted(){
        this.getDocuments()
    },
    watch:{
        selectedRequest(){
            console.log(this.selectedRequest)
        }
    },
    methods:{
        async getDocuments(){
            await this.$axios.get('/user/documents').then(response=>{
                this.documents = response.data
            })
        }
    }

}
</script>

<style scoped>
input[type=checkbox]{
    accent-color: yellow;
    @apply w-8 h-8 
}
input[type=checkbox]:after{
    border: solid white;
}

</style>