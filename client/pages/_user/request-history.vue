<template>
  <div class="main-container">
    <h1>Request History</h1>
    <p class="newRequest" @click="newRequest">+ MAKE NEW REQUEST</p><br>
    <SearchRequest /><br>
    <RequestHistoryTable />
  </div>
</template>

<script>
export default {
    layout: 'user',
    methods:{
      newRequest(){

      }
    }
}
</script>

<style>
.main-container{
  @apply pt-12 px-12 pb-12 text-black
}
h1{
  @apply text-2xl font-bold text-black
}
.newRequest{
  @apply text-right text-lg text-sky-700 font-bold
}

</style>