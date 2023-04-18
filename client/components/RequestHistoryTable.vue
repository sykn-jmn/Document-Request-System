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
            <td>{{request.request_date}}</td>
            <td>{{request.type}}</td>
            <td>{{request.status}}</td>
            <td>{{request.comments}}</td>
            <td>{{request.update_date}}</td>
            <td>{{request.action}}</td>
        </tr>
    </table>
    <div>
        <span></span>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            data:[
                {
                    id:1,
                    request_date: Date.now(),
                    type:"Baranggay Clearance",
                    status: "Pending",
                    comments: "adasdsad",
                    update_date: Date.now(),
                    action: "--"
                },
                {
                    id:2,
                    request_date: Date.now(),
                    type:"Certificate of Indigency",
                    status: "Approved",
                    comments: "adasdsad",
                    update_date: Date.now(),
                    action: "Pickup document"
                },
                {
                    id:3,
                    request_date: Date.now(),
                    type:"Business Permit",
                    status: "Rejected",
                    comments: "adasdsad",
                    update_date: Date.now(),
                    action: "Submit missing documents"
                },
                {
                    id:4,
                    request_date: Date.now(),
                    type:"Baranggay ID",
                    status: "Processing",
                    comments: "adasdsad",
                    update_date: Date.now(),
                    action: "--"
                },
                {
                    id:5,
                    request_date: Date.now(),
                    type:"Baranggay Clearance",
                    status: "Completed",
                    comments: "adasdsad",
                    update_date: Date.now(),
                    action: "--"
                },
                {
                    id:6,
                    request_date: Date.now(),
                    type:"Baranggay Clearance",
                    status: "Completed",
                    comments: "adasdsad",
                    update_date: Date.now(),
                    action: "--"
                },
                {
                    id:7,
                    request_date: Date.now(),
                    type:"Baranggay Clearance",
                    status: "Completed",
                    comments: "adasdsad",
                    update_date: Date.now(),
                    action: "--"
                }
            ]
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