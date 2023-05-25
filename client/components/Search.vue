<template>
  <div class="search-container">
    <select class="dropdown" v-model="select">
        <option v-for="option in options" :key="option" :value="option">{{option.charAt(0).toUpperCase() + option.slice(1)}}</option>
    </select>
    <div class="search-bar">
        <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
        <input type="text" v-model="searchValue"  :placeholder="placeholder" @keyup.enter="$emit('search',searchValue)">
    </div>
  </div>
</template>

<script>
export default {
    emits:['search'],
    props:['selected','options', 'placeholder'],
    data(){
        return{
            searchValue:"",
            select:this.selected
        }
    },
    watch:{
        
        select(value){
            if(this.$auth.$state.strategy == 'userAuth'){
                this.$router.push('/user/request-history/'+value)
            }
            this.$router.push('/admin/request-management/'+value)
            
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