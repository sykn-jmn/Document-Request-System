<template>
  <div class="modal" @click.self="$emit('closeModal')">
    <div class="content">
        <h1 class="text-3xl font-bold">REQUEST NO.{{renderID(details.id)}}</h1>
        <div class="grid grid-cols-3 gap-x-8">
            <div class="col-span-2">
                <div class="border-y border-slate-500 grid grid-cols-2">
                    <p>Full Name:</p>
                    <p class="font-semibold">{{details.first_name}} {{details.middle_name}} {{details.last_name}}</p>
                    <p>Age:</p>
                    <p class="font-semibold">{{getAge(details.birthdate)}}</p>
                    <p>Birthdate:</p>
                    <p class="font-semibold">{{details.birthdate}}</p>
                    <p>Sex/Gender:</p>
                    <p class="font-semibold">{{capitalize(details.sex)}}</p>
                    <p>Civil Status:</p>
                    <p class="font-semibold">{{capitalize(details.civil_status)}}</p>
                    <p>Complete Address:</p>
                    <p class="font-semibold">{{details.purok + ", " + details.barangay + ", " + details.municipality + ", " + details.province}}</p>
                    <p>Email:</p>
                    <p class="font-semibold">{{details.email}}</p>
                    <p>Mobile Number:</p>
                    <p class="font-semibold">{{details.mobile_number}}</p>
                </div><br>
                <h2>Requested Document</h2>
                <select v-model="document_id" class="py-2 px-4 border-black border mt-2" :disabled="details.status != 'pending'">
                    <option v-for="doc in documents" :value="doc.id" :key="doc.id">{{doc.name}}</option>
                </select>
                <!-- <div class="py-4 px-8 border border-slate-500 mt-2 w-fit rounded-md">
                    <p>{{details.document_name}}</p>
                </div> -->
                
            </div>
            <div>
                <h2>Pick-up Schedule</h2>
                <button class="border border-blue-500 rounded-md p-2 flex text-left items-center space-x-4 mt-2 w-full" @click="reschedModal = true" :disabled="details.status != 'pending'">
                    <font-awesome-icon :icon="['fas', 'calendar']" class="calendar-icon"/>
                    <div>
                        <p class="text-slate-500">Date</p>
                        <p class="font-semibold">{{getStringDate(date)}} {{meridiem}}</p>
                    </div>
                </button><br>
                <h2>Valid ID</h2>
                <div class="doc-container">
                    <div v-if="details.id_type=='image'" class="doc-wrapper">
                        <div class="flex items-center space-x-4 w-fit">
                            <font-awesome-icon :icon="['fas', 'image']" style="color: #dd5a03;" />
                            <p class="font-semibold">{{details.id_name}}</p>
                        </div>
                        <button class="view-file" @click="showImage(details.id_path)">View</button>
                    </div>
                    
                    <div v-if="details.id_type=='pdf'"></div>
                </div><br>
                <h2>Supporting Documents</h2>
                <div class="doc-container" v-for="document in details.request_supporting_dcouments" :key="document.id">
                    <div v-if="document.type=='image'" class="doc-wrapper">
                        <div class="flex items-center space-x-4 w-fit">
                            <font-awesome-icon :icon="['fas', 'image']" style="color: #dd5a03;" />
                            <p class="font-semibold">{{document.original_name}}</p>
                        </div>
                        <button class="view-file" @click="showImage(document.path)">View</button>
                    </div>
                    
                    <div v-if="document.type=='pdf'" class="doc-wrapper">
                        <div class="flex items-center space-x-4 w-fit">
                            <font-awesome-icon :icon="['fas', 'file-pdf']" style="color: #880bcb;" />
                            <p class="font-semibold">{{document.original_name}}</p>
                        </div>
                        <button class="view-file" @click="viewFile(document.filename)">View</button>
                    </div>
                </div>
            </div>
        </div>
        <h2>Purpose of Transaction</h2>
        <input v-model="purpose"/>
        <div class="w-fit m-auto flex space-x-4 mt-10">
            <button class="bg-slate-300 status-button text-black" @click="$emit('close')">
                <div class="status-wrapper">
                    <p>Cancel</p>
                </div>
            </button>
            <button class="bg-blue-500 status-button text-white" @click="updateRequest" :disabled="details.status != 'pending'">
                <div class="status-wrapper">
                    <p>Save</p>
                </div>
            </button>
        </div>
    </div>
    <ViewImage v-if="viewImage" :path="currentPath" @closeImage="viewImage=false"/>
    <ReschedModal v-if="reschedModal" @close="reschedModal = false" @selectedDate="selectedDate"/>
    <Spin v-if="spinning"/>
  </div>
</template>

<script>
import moment from 'moment'
export default {
    props:['details'],
    emits:['closeModal'],
    data(){
        return{
            data:[],
            viewImage:false,
            currentPath:'',
            spinning:false,
            purpose:'',
            reschedModal:false,
            date:'',
            meridiem:'',
            document_id:'',
            documents:'',

        }
    },
    mounted(){
        this.purpose = this.details.purpose
        this.date = this.details.schedule
        this.meridiem = this.details.meridiem 
        this.document_id = this.details.document_id

        this.getDocuments()

        this.$store.commit('request/updateFormData', {
            formData: new FormData(),
        });

    },
    methods:{
        async getDocuments(){
            this.spinning = true
            await this.$axios.get('/user/request/documents').then(response=>{
                this.documents = response.data
                this.spinning = false
            }).catch(err=>{
                this.spinning = false
            })
        },
        async updateRequest(){
            this.spinning = true
            var params ={
                id: this.details.id,
                document_id: this.document_id,
                schedule: this.date,
                meridiem: this.meridiem,
                purpose: this.purpose
            }
            await this.$axios.put('/user/request/update-request', params).then(response=>{
                this.spinning = false
                this.$emit('updated')
            }).catch(err=>{
                this.spinning = false
            })
        },
        async viewFile(filename){
            await this.$axios.get('/user/requests/get-pdf/'+filename,{responseType: 'blob'}).then(response=>{
                const blob = new Blob([response.data],{type: "application/pdf"})
                const objectUrl = window.URL.createObjectURL(blob)
                window.open(objectUrl);
            })
        },  
        showImage(path){
            this.currentPath = path
            this.viewImage = true

        },
        selectedDate(){
            this.reschedModal=false
            this.date = this.$store.state.request.selectedDate
            this.meridiem = this.$store.state.request.meridiem
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
        getAge(birthdate){

                var today = new Date();
                var birthDate = new Date(birthdate);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;

        },
        capitalize(word){
            return word.charAt(0).toUpperCase() + word.slice(1)
        },
        getStringDate(date){
            return moment(date).format('MMMM DD, yyyy')
        }
    }
}
</script>

<style scoped>
h2{
    @apply font-semibold text-xl
}
.calendar-icon{
    font-size:40px;
    @apply text-sky-900
}
.doc-container{
    @apply p-2 border-slate-300 rounded-md border mt-2 flex items-center space-x-4 justify-between
}
.doc-wrapper{
    @apply flex items-center space-x-4 justify-between w-full
}
.view-file{
    @apply py-2 px-4 rounded-md bg-blue-500 text-white
}
.status-button{
    @apply py-2 w-36 rounded-md
}
.thumbs-icon{
    @apply text-2xl text-white
}
.status-wrapper{
    @apply flex items-center space-x-4 w-fit m-auto
}

</style>