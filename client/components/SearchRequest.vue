<template>
  <div class="search-container">
    <select class="dropdown" v-model="selectRequest">
        <option value="all">All</option>
        <option value="completed" >Completed</option>
        <option value="approved" >Approved</option>
        <option value="processing" >Processing</option>
        <option value="pending" >Pending</option>
        <option value="rejected" >Rejected</option>
    </select>
    <div class="search-bar">
        <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
        <input type="text" v-model="searchRequest"  placeholder="Search Requested Document" @keyup.enter="$emit('search',searchRequest)">
    </div>
  </div>
</template>

<script>
export default {
    emits:['search'],
    props:['status'],
    data(){
        return{
            searchRequest:"",
            selectRequest:this.status
        }
    },
    watch:{
        selectRequest(value){
            this.$router.push('/user/request-history/'+value)
        }
    }
}
</script>

<style scoped>

.search-container{
    @apply py-2 px-4 rounded-xl bg-white shadow-xl text-lg flex text-black
}
.dropdown{
    @apply flex justify-between pr-10 w-48 focus:outline-none
}
.search-bar{
    @apply ml-4 border-0 border-l-2 border-slate-300 rounded-none flex items-center px-4 w-full
}
.search-bar > input{
    @apply focus:outline-none border-none w-full
}
</style>