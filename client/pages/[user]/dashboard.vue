<template>
    <div class="p-8 bg-white min-h-screen text-black">
        <div class="bg-slate-200 py-12 px-12 rounded-3xl mb-12">
            <span class="text-4xl "><b>{{dateNow()}}</b></span><br>
            <span class="text-2xl">Good morning, Jhumer!</span>
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
                <tr v-for="request in state.data" :key="request.id">
                    <td>{{request.request}}</td>
                    <td>{{request.request_date}}</td>
                    <td>{{request.status}}</td>
                    <td>{{request.remarks}}</td>

                </tr>
            </table>
        </div>
    </div>
</template>

<script lang="ts">
import moment from 'moment'
import {reactive} from 'vue'
export default {
    setup(){
        definePageMeta({
            layout: 'user'
        });
         
        const state = reactive({
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
        });

        const dateNow = () => moment().format('dddd, MMMM Do'); 

        
        return {dateNow, state}
    }
}
</script>

<style>

</style>