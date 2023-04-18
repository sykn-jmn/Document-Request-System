<template>
  <div class="flex justify-end">
    <div class="flex items-center justify-between text-lg">
    <button class="pr-8" @click="$emit('paginate', 'prev')" :disabled="disablePrev" v-if="!disablePrev"><font-awesome-icon :icon="['fas', 'angle-left']" /></button>
    <p>{{currentPage}} of {{lastPage}}</p>
    <button class="pl-8" @click="$emit('paginate', 'next')" :disabled="disableNext" v-if="!disableNext"><font-awesome-icon :icon="['fas', 'angle-right']" /></button>
  </div>
</div>
  
</template>

<script>
export default {
    props:['currentPage', 'lastPage'],
    emits:['paginate'],
    data(){
        return{
            disablePrev:false,
            disableNext:false,
        }
    },
    watch:{
        currentPage(){
            if(this.currentPage<2){
                this.disablePrev=true
            }else if(this.currentPage>=this.lastPage){
                this.disableNext=true
            }else{
                this.disablePrev = false
                this.disableNext = false
            }
        }
    }
}
</script>

<style scoped>

</style>