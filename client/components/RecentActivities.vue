<template>
    <div class="bg-white pt-8 px-8 h-fit rounded-3xl">
        <h2>Recent Activity</h2>
        <div class="mt-4" v-for="report in recentAcitvities" :key="report.id">
            <p class="font-semibold">{{report.message}}</p>
            <p class="mt-2 text-slate-500">{{convertDateToString(report.date)}}</p>
        </div>
        <div class="mt-8 border-t border-slate-300 p-4 h-fit">
            <p class="text-center text-blue-500 font-semibold text-xl">See All</p>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
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
.icon-container{
    @apply bg-yellow-400 w-32 h-32 p-4 rounded-2xl
}
.icon-wrapper{
    @apply w-fit m-auto
}
.icon{
    color:white;
    font-size:60px;
    margin:auto;
    text-align:center;
}

.info-icon{
    @apply text-sky-900 text-2xl
}
.notice-container{
    width: 600px;
}
.pending-icon{
    font-size:40px;
    @apply text-yellow-400
}
.approved-icon{
    font-size:40px;
    @apply text-white bg-green-400 p-2 rounded-lg
}
.rejected-icon{
    font-size:40px;
    @apply text-white bg-red-400 p-2 rounded-lg
}
.complete-icon{
    font-size:40px;
    @apply text-blue-400
}
.overview-container{
    @apply bg-white rounded-2xl w-80 mb-4 w-full
}
.first-container{
    @apply p-4 border-b-2 border-slate-200
}
.second-container{
    @apply p-4 text-sky-600 font-semibold flex items-center space-x-8 w-full
}

</style>