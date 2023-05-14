<template>
    <div class="bg-white pt-8 px-8 h-fit rounded-3xl text-black">
        <h2>Recent Activity</h2>
        <div class="mt-4" v-for="report in recentAcitvities" :key="report.id">
            <p class="font-semibold">{{report.message}} <span class="text-red-500">{{report.name}}</span></p>
            <p class="mt-2 text-slate-500">{{convertDateToString(report.date)}}</p>
        </div>
        <Pagination 
            :currentPage="currentPage"
            :lastPage="lastPage"
            @paginate="paginate"
        />
        <Spin v-if="spinning"/>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    layout:'admin',
    data(){
        return{
            currentPage: 1,
            lastPage:1,
            spinning:false,
            recentAcitvities:[]
        }
    },
    mounted(){
        this.getAllReports(this.currentPage)
    },
    methods:{
        paginate(value){
            switch(value){
            case "prev":
                var pageNumber = this.currentPage-1
                break;
            case"next":
                var pageNumber = this.currentPage+1
                break;
            default:
                var pageNumber = this.currentPage
            }
            this.fetchHistories(pageNumber,null)
        },
        async getAllReports(pageNumber){
            this.spinning = true
            this.$axios.get('/admin/get-all-reports?page='+pageNumber).then(response=>{
                this.recentAcitvities = response.data.data
                this.currentPage = response.data.current_page
                this.lastPage = response.data.last_page
                this.spinning = false
            })
        },
        recentDate(date){
            const dateNow = new Date()
            const diff =  dateNow - date
            return moment(diff).format('dddd, MMMM Do');
        },
        convertDateToString(date){
            return moment(date).format('MMMM Do, yyyy dddd')
        }
    }
}
</script>

<style scoped>
h2{
    @apply font-bold text-3xl
}

</style>