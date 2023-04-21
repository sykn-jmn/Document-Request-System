<template>
    <div class="p-8 bg-white min-h-screen text-black">
        <div class="bg-cyan-100 py-12 px-12 rounded-3xl mb-12">
            <span class="text-4xl text-cyan-700"><b>{{dateNow()}}</b></span><br>
            <span class="text-2xl">Good morning, {{$auth.state.user.first_name}}!</span>
        </div>
        <div class="border-b-2 border-slate-300 flex grid grid-cols-3 gap-x-8 pb-16">
            <div class="md:flex space-x-8">
                <button class="icon-container">
                    <div class="icon-wrapper">
                        <font-awesome-icon :icon="['fas', 'file-invoice']" class="icon"/>
                    </div>
                    <p class="text-white text-center">Request Document</p>
                </button>
                <button class="icon-container">
                    <div class="icon-wrapper">
                        <font-awesome-icon :icon="['fas', 'clock-rotate-left']" class="icon"/>
                    </div>
                    <p class="text-white text-center">Request History</p>
                </button>
                <button class="icon-container">
                    <div class="icon-wrapper">
                        <font-awesome-icon :icon="['fas', 'user']" class="icon"/>
                    </div>
                    <p class="text-white text-center">Account</p>
                </button>
            </div>
        </div>
        <div class="p-4 text-xl">
            <span class="font-bold text-3xl">Request Feed</span><br><br>
            <table>
                <thead class="border-y border-black text-left">
                    <th>Document Requested</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Remarks</th>
                </thead>
                <tr v-for="request in data" :key="request.id">
                    <td>{{request.request}}</td>
                    <td>{{request.request_date}}</td>
                    <td>{{request.status}}</td>
                    <td>{{request.remarks}}</td>

                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    layout: 'user',
    data(){
        return{
            data:[
                {
                    id:1,
                    request: "Baranggay Clearance",
                    request_date: Date.now(),
                    status: "Approved",
                    remarks: "Ready to claim"
                },
                {
                    id:2,
                    request: "Baranggay Health Certificate",
                    request_date: Date.now(),
                    status: "Denied",
                    remarks: "Incomplete requiremens"
                },
            ]
        }
    },
    methods:{
        dateNow(){
            return moment().format('dddd, MMMM Do'); 
        }
    }
}
</script>

<style scoped>
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

</style>