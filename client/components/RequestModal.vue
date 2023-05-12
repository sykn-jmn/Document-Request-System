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
                    <p class="font-semibold">{{details.purok + ", " + details.baranggay + ", " + details.municipality + ", " + details.province}}</p>
                    <p>Email:</p>
                    <p class="font-semibold">{{details.email}}</p>
                    <p>Mobile Number:</p>
                    <p class="font-semibold">{{details.mobile_number}}</p>
                </div><br>
                <h2>Purpose of Transaction</h2>
                <div class="bg-stone-200 p-4 rounded-md border border-stone-500 mt-2">
                    {{details.purpose}}
                </div>
            </div>
            <div>
                <h2>Pick-up Schedule</h2>
                <div class="border border-blue-500 rounded-md p-2 flex items-center space-x-4 mt-2">
                    <font-awesome-icon :icon="['fas', 'calendar']" class="calendar-icon"/>
                    <div>
                        <p class="text-slate-500">Date</p>
                        <p class="font-semibold">{{getStringDate(details.schedule)}} {{details.meridiem}}</p>
                    </div>
                </div><br>
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
        <h2>Comments/Remarks</h2>
        <textarea rows="4" v-model="comments"></textarea>
        <div class="w-fit m-auto flex text-white space-x-4 mt-10">
            <button class="bg-red-500 status-button" @click="submit('rejected')">
                <div class="status-wrapper">
                    <font-awesome-icon :icon="['fas', 'thumbs-down']" flip="horizontal" class="thumbs-icon"/>
                    <p>Reject</p>
                </div>
            </button>
            <button class="bg-green-500 status-button" @click="submit('approved')">
                <div class="status-wrapper">
                    <font-awesome-icon :icon="['fas', 'thumbs-up']" class="thumbs-icon"/>
                    <p>Approve</p>
                </div>
            </button>
        </div>
    </div>
    <ViewImage v-if="viewImage" :path="currentPath" @closeImage="viewImage=false"/>
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
            comments:'',
            spinning:false,
        }
    },
    mounted(){

    },
    methods:{
        async submit(status){
            this.spinning =true
            var params = {
                id: this.details.id,
                status: status,
                comments:comments

            }
            await this.$axios.put('/admin/requests/update-status',params).then(response=>{
                this.$emit('closeModal')
                this.spinning =false
            }).catch(err=>{
                this.spinning =false
            })
        },
        async viewFile(filename){
            await this.$axios.get('/admin/requests/get-pdf/'+filename,{responseType: 'blob'}).then(response=>{
                const blob = new Blob([response.data],{type: "application/pdf"})
                const objectUrl = window.URL.createObjectURL(blob)
                window.open(objectUrl);
            })
        },
        showImage(path){
            this.currentPath = path
            this.viewImage = true

        },
        renderID(id){
            console.log(id)
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