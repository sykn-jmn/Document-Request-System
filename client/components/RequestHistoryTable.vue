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
        <td>{{request.status}}</td>
        <td>{{comment(request.status)}}</td>
        <td>{{numericDate(request.update_date)}}</td>
        <td>{{action(request.status)}}</td>
    </tr>

    </table>
    <div>
        <span></span>
    </div>
  </div>
</template>

<script>
import moment from 'moment'
export default {
    props:['data'],
    data(){
        return{
        }
    },
    methods:{
        numericDate(date){
            return moment(date).format('yyyy-MM-DD')
        },
        action(status){
            if(status == 'approved'){
                return 'Pickup Document'
            }else if(status == 'rejected'){
                return 'Submit missing documents'
            }else{
                return "-"
            }
        },
        comment(status){
            if(status == 'approved'){
                return 'Document ready for pickup'
            }else if(status == 'rejected'){
                return 'Incomplete requirements'
            }else{
                return "-"
            }
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
</style>