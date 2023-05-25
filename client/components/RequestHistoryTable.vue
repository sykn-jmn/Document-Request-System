<template>
  <div>
    <table class="table-history">
        <thead class="border-y text-left">
            <th>Request Date</th>
            <th>Document Type</th>
            <th>Request Status</th>
            <th>Comments/Notes</th>
            <th>Updated Date</th>
            <th>Action Required</th>
        </thead>
   
    <tr v-for="request in data" :key="request.id">
        <td>{{numericDate(request.request_date)}}</td>
        <td>{{request.type}}</td>
        <td><span :class="request.status">{{request.status}}</span></td>
        <td>{{request.comments}}</td>
        <td>{{numericDate(request.updated_date)}}</td>
        <td>
            <div v-if="request.status != 'rejected'" class="flex text-2xl space-x-4 w-fit">
                <button class="hover:text-blue-900 text-left" @click="view(request.id)"><font-awesome-icon :icon="['fas', 'pen-to-square']" class="text-slate-900"/></button>
                <button class="hover:text-blue-900 text-left" @click="cancel(request.id)"><font-awesome-icon :icon="['fas', 'trash']" class="text-red-500"/></button>     
            </div>
            <div v-else>
                <button class="hover:text-blue-900 w-full">Submit Missing Documents</button>
            </div>
        </td>
    </tr>

    </table>
    <div>
        <span></span>
    </div>
    <ConfirmationModal :message="message" @close="confirmModal = false" @delete="deleteRequest" v-if="confirmModal" />
    <ViewRequestModal v-if="viewModal" @close="viewModal = false" @updated="updated" :details="details"/>
    <Spin v-if="spinning" />
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
            viewModal:false,
            selectedId:'',
            spinning:false,
            details:'',
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
        view(id){
            this.selectedId = id
            this.getRequest(id)
        },
        async deleteRequest(){
            this.spinning = true
            await this.$axios.delete('/user/request/delete-request/'+this.selectedId).then(response=>{
                this.$emit('refresh')
                this.confirmModal = false
                this.spinning = false
            })
        },
        updated(){
            this.viewModal = false
            this.$emit('refresh')
        },
        async getRequest(id){
            this.spinning = true
            await this.$axios.get('/user/request/get-request/'+id).then(response=>{
                this.details = response.data
                this.viewModal = true
                this.spinning = false
            }).catch(err=>{
                console.log(err)
                this.spinning = false
            })
            
        },
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