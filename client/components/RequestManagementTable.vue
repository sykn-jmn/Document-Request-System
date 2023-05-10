<template>
  <div>
    <table class="table-history">
        <thead class="border-y text-left">
            <th>Request No.</th>
            <th>Pick-Up-Schedule</th>
            <th>Document Type</th>
            <th>Requested by</th>
            <th>Requested Status</th>
        </thead>
   
    <tr v-for="request in data" :key="request.id" @click="view(request.id)" class="cursor-pointer">
        <td>#{{renderID(request.id)}}</td>
        <td>{{numericDate(request.schedule)}}</td>
        <td>{{request.document}}</td>
        <td>{{request.first_name}} {{request.last_name}}</td>
        <td><span :class="request.status">{{request.status}}</span></td>
    </tr>
    </table>
    <div>
        <span></span>
    </div>
    <RequestModal :details="details" v-if="showModal" @closeModal="showModal = false"/>
    <Spin v-if="spinning"/>
  </div>
</template>

<script>
import moment from 'moment'
export default {
    props:['data'],
    data(){
        return{
            showModal:false,
            details:'',
            spinning:false
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
        },
        renderID(id){
            const charID = id.toString()
            if(charID.length<6){
                const zerosToAdd = 6 - charID.length
                let stringID = ""
                for(let i = 0; i < zerosToAdd; i++){
                    stringID += "0"
                    
                }
                stringID = stringID + charID
                return stringID 
            }
            return id
        },
        async view(id){
            this.spinning = true
            await this.$axios.get('/admin/get-request/'+id).then(response=>{
                this.details = response.data
                this.showModal = true
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