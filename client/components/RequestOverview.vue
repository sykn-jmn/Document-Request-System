<template>
  <div class="px-8 rounded-3xl">
        <h2>Request Overview</h2><br>
        <div class="grid grid-cols-2 gap-x-8">
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
                <button class="second-container" @click="$router.push('/admin/request-management/pending')">
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
                <button class="second-container" @click="$router.push('/admin/request-management/approved')">
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
                <button class="second-container" @click="$router.push('/admin/request-management/rejected')">
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
                <button class="second-container" @click="$router.push('/admin/request-management/completed')">
                    <span>See all completed request</span>
                    <font-awesome-icon :icon="['fas', 'arrow-right']" />
                </button>
            </div>
        </div>
        <RegisteredResidents />
    </div>
</template>

<script>
export default {
    data(){
        return{
            countRequest:'',    
        }
    },
    mounted(){
        this.getCountRequest()
    },
    methods:{
        async getCountRequest(){
            await this.$axios.get('/admin/dashboard/count-request').then(response=>{
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
    @apply bg-white rounded-2xl w-80 mb-4 w-fit
}
.first-container{
    @apply p-4 border-b-2 border-slate-200
}
.second-container{
    @apply p-4 text-sky-600 font-semibold flex items-center space-x-8 w-full
}
h2{
    @apply font-bold text-3xl
}

</style>