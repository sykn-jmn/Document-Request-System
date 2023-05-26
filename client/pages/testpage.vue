<template>
<div class="bg-white w-screen h-screen text-black">
    <div class=" m-auto">
        <label for="file">
            <div class="w-full h-80 border border-dashed border-black relative">
                <div class="icon-wrapper">
                    <font-awesome-icon :icon="['fas', 'file-import']" class="text-blue-500 file-icon"/><br><br>
                    <p>Drop your file here or <span class="text-blue-500 font-semibold">Browse</span></p>
                </div>
            </div>
            <input type="file" id="file" v-on:change="change"/>
        </label>
        <div v-for="(file,i) in files" :key="i" class="float-left relative p-2">
            <button class="text-left absolute top-0 right-0" @click="remove(i)"><font-awesome-icon :icon="['fas', 'xmark']"/></button>
            <div class="text-center w-20 bg-red-100">
                <font-awesome-icon :icon="['fas', 'file']" class="selected-file"/>
                <p>{{file.name}}</p>
            </div>
        </div>
    </div>
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