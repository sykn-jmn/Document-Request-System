<template>
  <div class="main-container">
    <h1>Request History</h1>
    <p class="newRequest" @click="newRequest">+ MAKE NEW REQUEST</p><br>
    <SearchRequest /><br>
    <RequestHistoryTable />
    <Pagination 
      :currentPage="currentPage"
      :lastPage="lastPage"
      @paginate="paginate"
    />
  </div>
</template>

<script>
export default {
    layout: 'user',
    data(){
      return{
        currentPage: 1,
        lastPage:1,
      }
    },
    mounted(){
      this.fetchHistories(this.currentPage)
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
        this.fetchHistories(pageNumber)
      },
      async fetchHistories(pageNumber){
        await this.$axios.get('/test?page=' + pageNumber).then(response=>{
          console.log(response)
          this.currentPage = response.data.current_page
          this.lastPage = response.data.last_page
        })
      }
    }
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