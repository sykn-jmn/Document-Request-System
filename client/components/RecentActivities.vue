<template>
    <div class="bg-white pt-8 px-8 h-fit rounded-3xl">
        <h2>Recent Activity</h2>
        <div class="mt-4" v-for="report in recentAcitvities" :key="report.id">
            <p class="font-semibold">{{report.message}}</p>
            <p class="mt-2 text-slate-500">{{convertDateToString(report.date)}}</p>
        </div>
        <div class="mt-8 border-t border-slate-300 p-4 h-fit cursor-pointer" @click="$router.push('/admin/recent-activities')">
            <p class="text-center text-blue-500 font-semibold text-xl">See All</p>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    layout:'admin',
    data(){
        return{
            recentAcitvities:[
                {
                    id: 1,
                    message: 'Request #000051 (Barangay Clearance) was approved by Admin1',
                    status:'approved',
                    date: new Date(2023,4,3)
                },
                {
                    id: 2, 
                    message: 'Request #000050 (Cedula) was claimed by Juan Dela Cruz',
                    status:'claimed',
                    date: new Date(2023,4,5)
                }
            ]
        }
    },
    methods:{
        recentDate(date){
            const dateNow = new Date()
            const diff =  dateNow - date
            return moment(diff).format('dddd, MMMM Do');
        },
        convertDateToString(date){
            return moment(date).format('MMMM Do, yyyy dddd')
        }
    }
}
</script>

<style scoped>
h2{
    @apply font-bold text-3xl
}


</style>