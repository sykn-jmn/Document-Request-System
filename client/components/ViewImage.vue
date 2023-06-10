<template>
    <div class="fullpage">
        <div class="m-auto w-fit relative">
            <button class="absolute right-0" @click="$emit('closeImage')">
                <font-awesome-icon :icon="['fas', 'circle-xmark']"  class="x-mark"/>
            </button>
            <a class="w-fit">
                <img :src="getImgUrl()">
            </a>
        </div>
    </div>


</template>

<script>
export default {
    emits:['closeImage'],
    props:['path','reupload'],
    methods:{
        getImgUrl(){
          if(this.reupload){
            return this.path
          }else{
            return require("../storage/app/public/"+this.path)
          }
      }
    }
}
</script>

<style scoped>
.fullpage{
    @apply fixed w-screen h-screen bg-black top-0 left-0 flex items-center z-10
}
.x-mark{
    font-size:30px;
    @apply text-slate-500
}
</style>