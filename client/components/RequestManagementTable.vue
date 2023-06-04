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
   
    <tr v-for="request in data" :key="request.id" @click="view(request.id,request.status,request.document_id, request.user_id)" class="cursor-pointer">
        <td>#{{renderID(request.id)}}</td>
        <td>{{numericDate(request.schedule)}}</td>
        <td>{{request.document_name}}</td>
        <td>{{request.first_name}} {{request.last_name}}</td>
        <td><span :class="request.status">{{request.status}}</span></td>
    </tr>
    </table>
    <div>
        <span></span>
    </div>
    <RequestModal :details="details" v-if="showRequestModal" @closeModal="showRequestModal = false"/>
    <ApprovedModal :details="details" v-if="showApprovedModal" @closeModal="closeApproveModal" @viewDocument="generatePDF"/>
    <div id="content">
        <BarangayPermit v-if="doc_id == 2" :user="user"/>
        <BarangayClearance v-if="doc_id == 3" :user="user"/>
        <BarangayClearanceBusiness v-if="doc_id == 4" :user="user"/>
        <BarangayCeritificateResidency v-if="doc_id == 5" :user="user"/>
        <BarangayCeritificateIndigency v-if="doc_id == 6" :user="user"/>
    </div>
    
    
    
    <Spin v-if="spinning"/>
  </div>
</template>

<script>
import jsPDF from'jspdf'
import moment from 'moment'
export default {
    props:['data'],
    data(){
        return{
            showRequestModal:false,
            showApprovedModal:false,
            details:'',
            spinning:false,
            status:'pending',
            doc_id:'',
            user:'',
        }
    },
    methods:{
        closeApproveModal(){
            this.doc_id = ''
            this.showApprovedModal = false
        },
        async generatePDF(){
            this.spinning =  true
            const doc = new jsPDF(undefined, undefined, 'a4');
            var elementHTML = document.getElementById("content");

            await doc.html(elementHTML, {
                callback: function(doc) {
                    // Save the PDF
                    const pdfBlob = doc.output('blob');
                    const pdfUrl = URL.createObjectURL(pdfBlob);
                    window.open(pdfUrl,'_blank');
                    
                },
                x: 0,
                y: 0,
                width: 171,
                windowWidth: 650
            });
            this.spinning=false 
        },
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
        async view(id,status,doc_id, user_id){
            this.spinning = true
             await this.$axios.get('/admin/request/get-request/'+id).then(response=>{
                    this.details = response.data
                    this.status = status
                    if(status =='pending'){
                        this.showRequestModal = true
                    }else if(status == 'approved'){
                        this.getResidentDetails(user_id,doc_id)
                        this.showApprovedModal = true
                    }
                    this.spinning = false
                }).catch(err=>{
                    console.log(err)
                    this.spinning = false
                })
        },
        async getResidentDetails(user_id,doc_id){
            var params = {
                user_id:user_id
            }
            await this.$axios.get('/admin/residents/get-resident-details',{params}).then(response=>{
                this.user = response.data
                this.doc_id = doc_id
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
#content{
    width:210mm;
    height:297mm;
    font-family: "Times New Roman", Times, serif;
    @apply text-center text-black m-auto relative
}
</style>