<template>
<div class="bg-white w-screen h-screen text-black">
    <UploadFiles />
</div>
  
</template>

<script>
export default {
    data(){
        return{
            files:[]
        }
    },
    methods:{
        change(e){
            this.files.push(e.target.files[0])
        },
        remove(index){
            this.files.splice(index,1)
        }
    }

}
</script>

<style scoped>
input{
    @apply hidden
}
.file-icon{
    font-size:50px;
    @apply text-center
}
.icon-wrapper{
    @apply m-auto w-fit mt-32 text-center text-black
}
.selected-file{
    font-size:30px;
    @apply text-sky-700
}
</style>