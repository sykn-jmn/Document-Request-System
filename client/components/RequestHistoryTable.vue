<template>
  <div>
    <table class="table-history">
        <thead class="border-y text-left">
            <th>Request Date</th>
            <th>Document Type</th>
            <th>Request Status</th>
            <th>Comments/Notes</th>
            <th>Update Date</th>
            <th>Action Required</th>
        </thead>
   
    <tr v-for="request in data" :key="request.id">
        <td>{{numericDate(request.request_date)}}</td>
        <td>{{request.type}}</td>
        <td><span :class="request.status">{{request.status}}</span></td>
        <td>{{request.comments}}</td>
        <td>{{numericDate(request.update_date)}}</td>
        <td>
            <div v-if="request.status != 'rejected'" class="text-center text-blue-500">
                <button class="hover:text-blue-900 p-2" @click="cancel(request.id)">Cancel</button>
                <hr>
                <button class="hover:text-blue-900 p-2" @click="resched(request.id)">Resched</button>
            </div>
            <div v-else>
                <button class="hover:text-blue-900 p-2">Submit Missing Documents</button>
            </div>
        </td>
    </tr>

    </table>
    <div>
        <span></span>
    </div>
    <ConfirmationModal :message="message" @close="confirmModal = false" @delete="deleteRequest" v-if="confirmModal" />
    <ReschedModal />
  </div>
</template>

<script>
import moment from 'moment'
export default {
    props:['data'],
    data(){
        return{
            message:'',
            confirmModal:false,
            selectedId:'',
        }
    },
    methods:{
        numericDate(date){
            return moment(date).format('yyyy-MM-DD')
        },
        cancel(id){
            this.selectedId = id
            this.message = "Are you sure you want to cancel you request?"
            this.confirmModal=true
            
        },
        async deleteRequest(){
            await this.$axios.delete('/user/request/delete-request/'+this.selectedId).then(response=>{
                this.$emit('refresh')
                this.confirmModal = false
            })
        }
    }

}
</script>

<style scoped>
table{
    border-collapse: separate;
    border-spacing: 0 8px; 
    @apply w-full
}
th{
    @apply p-8
}
tr{
    background:white;
}
td{
    @apply w-fit p-8
}
.pending{
    @apply bg-yellow-400 w-fit text-white px-8 py-2 rounded-2xl
}
.rejected{
    @apply bg-red-500 w-fit text-white px-8 py-2 rounded-2xl
}
.approved{
    @apply bg-green-400 w-fit text-white px-8 py-2 rounded-2xl
}
.completed{
    @apply bg-blue-500 w-fit text-white px-8 py-2 rounded-2xl
}
.processing{
    @apply bg-stone-500 w-fit text-white px-8 py-2 rounded-2xl
}
</style>