<template>
  <div class="main-container">
    <h1>Request Management</h1>
    <Search 
      @search="search" 
      :selected="$route.params.index" 
      :options="options" 
      placeholder="Search Requested Document"
    />
    <RequestManagementTable :data="data"/>
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
    layout: 'admin',
    data(){
      return{
        data:[],
        currentPage: 1,
        lastPage:1,
        spinning:false,
        options:['all','completed','approved','processing','pending','rejected'],
      }
    },
    mounted(){
      this.fetchHistories(this.currentPage)
    },
    watch:{
      '$store.state.trigger.refreshRequestTable'(){
        this.fetchHistories()
      }
    },
    methods:{
      newRequest(){

      },
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
      async fetchHistories(pageNumber,search){
        this.spinning = true
        var params = {
          search:search
        }
        await this.$axios.get('/admin/request/get-requests/'+this.$route.params.index+'?page=' + pageNumber, {params}).then(response=>{
          this.data = response.data.data
          this.currentPage = response.data.current_page
          this.lastPage = response.data.last_page
          this.spinning = false
        }).catch(err=>{
          this.spinning = false
        })
      },
    search(value){
      this.fetchHistories(1,value)
    }
  },

}
</script>

<style scoped>
.main-container{
  @apply pt-12 px-12 pb-12 text-black min-h-screen
}
h1{
  @apply text-2xl font-bold text-black
}
.newRequest{
  @apply text-right text-lg text-sky-700 font-bold
}

</style>