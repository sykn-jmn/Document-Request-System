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
                            <p class="font-semibold">{{reupload_id.name?reupload_id.name:details.id_name}}</p>
                        </div>
                        <div>
                            <button class="view-file" @click="showImage(details.id_path)">View</button>
                            <label for="reupload" class="reupload">
                                Reupload
                                <input type="file" id="reupload" accept="application/pdf, image/jpg, image/png, image/jpeg" v-on:change="reupload" hidden> 
                            </label>
                        </div>
                    </div>
                    
                    <div v-if="details.id_type=='pdf'"></div>
                </div><br>
                <h2>Supporting Documents</h2><br>
                <label for="supporting_documents" class="reupload">
                    Add Files
                    <input type="file" id="supporting_documents" accept="application/pdf, image/jpg, image/png, image/jpeg" v-on:change="addFiles" multiple hidden> 
                </label>
                <div class="doc-container" v-for="(document,i) in supporting_documents" :key="i">
                    <div v-if="document.type=='image' || document.type.split('/')[0] =='image'" class="doc-wrapper">
                        <div class="flex items-center space-x-4 w-fit">
                            <font-awesome-icon :icon="['fas', 'image']" style="color: #dd5a03;" />
                            <p class="font-semibold">{{document.original_name?document.original_name:document.name}}</p>
                        </div>
                        <div class="">
                            <button class="view-file" @click="showImage(document.path)" v-if="document.path">View</button>
                            <button class="delete" @click="deleteFile(i)">Delete</button>
                        </div>
                    </div>
                    
                    <div v-if="document.type=='pdf' || document.type.split('/')[1] =='pdf'" class="doc-wrapper">
                        <div class="flex items-center space-x-4 w-fit">
                            <font-awesome-icon :icon="['fas', 'file-pdf']" style="color: #880bcb;" />
                            <p class="font-semibold">{{document.original_name?document.original_name:document.name}}</p>
                        </div>
                        <div class="">
                            <button class="view-file" @click="viewFile(document.filename)" v-if="document.filename">View</button>
                            <button class="delete" @click="deleteFile(i)">Delete</button>
                        </div>
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
    <ViewImage v-if="viewImage" :path="currentPath" @closeImage="viewImage=false" :reupload="isReupload"/>
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
            reupload_id:'',
            reupload_id_path:'',
            isReupload:false,
            remove_id:'',
            supporting_documents:[],
            remove_files:[],

        }
    },
    mounted(){
        this.purpose = this.details.purpose
        this.date = this.details.schedule
        this.meridiem = this.details.meridiem 
        this.document_id = this.details.document_id
        this.supporting_documents = this.details.request_supporting_dcouments

        this.getDocuments()

        this.$store.commit('request/updateFormData', {
            formData: new FormData(),
        });

    },
    methods:{
        reupload(e){
            this.reupload_id = e.target.files[0];

            if(this.reupload_id){
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.isReupload = true
                    this.reupload_id_path = e.target.result

                    this.remove_id = {
                        id:this.details.id_id,
                        filename:this.details.id_filename

                    }
                };
                reader.readAsDataURL(this.reupload_id);
            }
        },
        addFiles(e){
            const files = e.target.files
            
            if(files && files.length>0){
                for(let i = 0; i<files.length; i++){
                    // let type = files[i].type.split('/')[0] == 'image'? 'image': 'pdf'
                    this.supporting_documents.push(files[i])
                }
            }
        },
        deleteFile(i){
            let removedFile = this.supporting_documents.splice(i,1)
            this.remove_files.push({
                id:removedFile[0].id,
                filename: removedFile[0].filename
            })
        },
        
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
                    const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
          }
            let formData = new FormData()
            formData.append('request_id', JSON.stringify(this.details.id))
            formData.append('document_id', this.document_id)
            formData.append('schedule', this.date)
            formData.append('meridiem', this.meridiem)
            formData.append('purpose', this.purpose)
            formData.append("valid_id", this.reupload_id);
            formData.append('remove_id', JSON.stringify(this.remove_id))
            for (let i = 0; i < this.supporting_documents.length; i++) {
                formData.append(
                    "supporting_document[" + i + "]",
                    this.supporting_documents[i]
                );
            }
            formData.append('remove_files', JSON.stringify(this.remove_files))

            await this.$axios.post('/user/request/update-request', formData,config).then(response=>{
                this.spinning = false
                this.$emit('updated')
            }).catch(err=>{
                this.spinning = false
            })
        },
        async viewFile(filename){
            await this.$axios.get('/user/request/get-pdf/'+filename,{responseType: 'blob'}).then(response=>{
                const blob = new Blob([response.data],{type: "application/pdf"})
                const objectUrl = window.URL.createObjectURL(blob)
                window.open(objectUrl);
            })
        },  
        showImage(path){
            this.currentPath = this.reupload_id_path?this.reupload_id_path:path
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
.delete{
    @apply py-2 px-4 rounded-md bg-red-500 text-white
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
.reupload{
    @apply py-2 px-4 rounded-md bg-slate-200 text-black cursor-pointer
}


</style>