<template>
  <div class="search-container">
    <select class="dropdown">
        <option value="all" selected>All</option>
    </select>
    <div class="search-bar">
        <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
        <input type="text" v-model="searchRequest"  placeholder="Search Requested Document">
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            searchRequest:"",
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