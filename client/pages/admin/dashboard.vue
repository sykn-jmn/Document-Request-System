<template>
    <div class="p-8 bg-slate-100 min-h-screen text-black">
        <div class="bg-cyan-100 py-12 px-12 rounded-3xl mb-12">
            <span class="text-4xl text-cyan-700"><b>{{dateNow()}}</b></span><br>
            <span class="text-2xl">Good morning, {{$auth.state.user.first_name}}!</span>
        </div>
        <div class="grid grid-cols-2">
            <RecentActivities />
            <RequestOverview />
            <RegisteredResidents />
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    layout: 'admin',
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
            await this.$axios.get('/user/count-request').then(response=>{
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
    @apply bg-white rounded-2xl w-80 mb-4 w-full
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