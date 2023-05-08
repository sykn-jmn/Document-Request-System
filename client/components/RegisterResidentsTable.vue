<template>
  <div>
    <table class="table-history">
        <thead class="border-y text-left">
            <th>Full Name</th>
            <th>Registration Date</th>
            <th>Sex</th>
            <th>Contact Information</th>
            <th>Address</th>
        </thead>
   
    <tr v-for="resident in data" :key="resident.id">
        <td>{{resident.first_name}} {{resident.last_name}}</td>
        <td>{{resident.email_verified_at}}</td>
        <td>
            <div>
                <p>{{resident.email}}</p>
                <p>{{resident.mobile_number}}</p>
            </div>
        </td>
        <td>{{resident.purok+" "+resident.branggay+" "+resident.municipality+" "+resident.province}}</td>
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