<template>
    <div class="p-8 bg-slate-100 min-h-screen text-black">
        <div class="bg-cyan-100 py-12 px-12 rounded-3xl mb-12">
            <span class="text-4xl text-cyan-700"><b>{{dateNow()}}</b></span><br>
            <span class="text-2xl">Good morning, {{$auth.state.user.first_name}}!</span>
        </div>
        <div class="border-b-2 border-slate-300 flex space-x-16 pb-16">
            <div class="md:flex space-x-8 md:pl-24">
                <button class="icon-container" @click="$router.push('/user/request')">
                    <div class="icon-wrapper">
                        <font-awesome-icon :icon="['fas', 'file-invoice']" class="icon"/>
                    </div>
                    <p class="text-white text-center">Request Document</p>
                </button>
                <button class="icon-container" @click="$router.push('/user/request-history/all')">
                    <div class="icon-wrapper">
                        <font-awesome-icon :icon="['fas', 'clock-rotate-left']" class="icon"/>
                    </div>
                    <p class="text-white text-center">Request History</p>
                </button>
                <button class="icon-container" @click="$router.push('/user/account')">
                    <div class="icon-wrapper">
                        <font-awesome-icon :icon="['fas', 'user']" class="icon"/>
                    </div>
                    <p class="text-white text-center">Account</p>
                </button>
            </div>
            <div class="rounded-2xl bg-white p-4 notice-container">
                <div class="flex items-center space-x-2">
                    <font-awesome-icon :icon="['fas', 'circle-info']" class="info-icon"/>
                    <span class="text-2xl font-medium text-sky-900">Notice</span>
                </div>
                <p class="mt-2">The barangay office is closed every Saturday and Sunday. Requested documents can be claimed form Monday to Friday during the office hours.</p>
            </div>
        </div>
        <div class="pt-12 pl-8">
            <h1 class="text-3xl font-bold">Request Overview</h1><br>
            <div class="space-x-8">
                <div class="overview-container">
                    <div class="first-container">
                        <div class="flex items-center space-x-4">
                            <font-awesome-icon :icon="['fas', 'circle-exclamation']" class="pending-icon"/>
                            <div>
                                <p class="text-xl text-slate-500">Pending</p>
                                <p class="font-bold text-2xl">{{countRequest.pending}}</p>
                            </div>
                        </div>
                    </div>
                    <button class="second-container" @click="$router.push('/user/request-history/pending')">
                        <span>See all pending request</span>
                        <font-awesome-icon :icon="['fas', 'arrow-right']" />
                    </button>
                </div>
                <div class="overview-container">
                    <div class="first-container">
                        <div class="flex items-center space-x-8">
                            <font-awesome-icon :icon="['fas', 'thumbs-up']" class="approved-icon"/>
                            <div>
                                <p class="text-xl text-slate-500">Approved</p>
                                <p class="font-bold text-2xl">{{countRequest.approved}}</p>
                            </div>
                        </div>
                    </div>
                    <button class="second-container" @click="$router.push('/user/request-history/approved')">
                        <span>See all approved request</span>
                        <font-awesome-icon :icon="['fas', 'arrow-right']" />
                    </button>
                </div>
                <div class="overview-container">
                    <div class="first-container">
                        <div class="flex items-center space-x-8">
                            <font-awesome-icon :icon="['fas', 'thumbs-down']" flip="horizontal" class="rejected-icon" />
                            <div>
                                <p class="text-xl text-slate-500">Rejected</p>
                                <p class="font-bold text-2xl">{{countRequest.rejected}}</p>
                            </div>
                        </div>
                    </div>
                    <button class="second-container" @click="$router.push('/user/request-history/rejected')">
                        <span>See all rejected request</span>
                        <font-awesome-icon :icon="['fas', 'arrow-right']" />
                    </button>
                </div>
                <div class="overview-container">
                    <div class="first-container">
                        <div class="flex items-center space-x-8">
                            <font-awesome-icon :icon="['fas', 'circle-check']" class="complete-icon"/>
                            <div>
                                <p class="text-xl text-slate-500">Completed</p>
                                <p class="font-bold text-2xl">{{countRequest.completed}}</p>
                            </div>
                        </div>
                    </div>
                    <button class="second-container" @click="$router.push('/user/request-history/completed')">
                        <span>See all completed request</span>
                        <font-awesome-icon :icon="['fas', 'arrow-right']" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    layout: 'user',
    data(){
        return{
            countRequest:'',
        }
    },
    mounted(){
        this.getCountRequest()
    },
    methods:{
        dateNow(){
            return moment().format('dddd, MMMM Do'); 
        },
        async getCountRequest(){
            await this.$axios.get('/user/dashboard/count-request').then(response=>{
                this.countRequest = response.data
            }  
            ).catch(err =>{
                console.log(err)
            })
        },
    }
}
</script>

<style scoped>
.icon-container{
    @apply bg-red-500 w-32 h-32 p-4 rounded-2xl
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
    @apply bg-white rounded-2xl w-80 float-left mb-4
}
.first-container{
    @apply p-4 border-b-2 border-slate-200
}
.second-container{
    @apply p-4 text-sky-600 font-semibold flex items-center space-x-8 w-full
}

</style>