<template>
    <div class="bg-slate-100 min-h-screen text-black">
        <SelectDocuments  v-if="page==1" @selectedDocuments="getSelectedDocuments"/>
        <RequestForm v-if="page==2"/>
        <PickUpSchedule v-if="page==3" @selectedDate="getSelectedDate"/>
        <div class="m-auto mt-4 space-x-4 w-fit">
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page==1">Cancel</button>
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page>1" @click="page--">Back</button>
            <button class="bg-yellow-400 text-white px-20 py-2 rounded-lg" @click="page++">Next</button>
        </div>
    </div>
</template>

<script>
export default {
    layout: 'user',
    data(){
        return{
            page:3,
            buttonStatus: "isButtonDisabled",
            selectedDate:{},
            selectedDocuments:[]
        }
    },
    methods:{
        getSelectedDate(value){
            this.selectedDate =  value
        },
        getSelectedDocuments(value){
            this.selectedDocuments = value
        }
    }
}
</script>

<style scoped>


</style>