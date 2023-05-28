<template>
    <div class=" w-full">
        <div class="w-full">
            <div class="w-full h-80 border border-dashed border-black relative">
                <label :for="id" class="w-full h-full p-0 cursor-pointer mb-8">
                    <input type="file" :id="id" v-on:change="onChange" ref="file"/>
                    <div class="icon-wrapper">
                        <font-awesome-icon :icon="['fas', 'file-import']" class="text-blue-500 file-icon"/><br><br>
                        <p>Drop your file here or <span class="text-blue-500 font-semibold">Browse</span></p>
                    </div>
                </label>
                </div>
            
        </div><br>
        
        <div v-for="(file,i) in files" :key="i" class="float-left relative p-4 border border-blue-500 text-center rounded-md ml-2 mb-2">
            <button class="text-right absolute top-0 right-1" @click="remove(i)"><font-awesome-icon :icon="['fas', 'xmark']"/></button>
            <div class="text-center w-fit">
                <!-- <font-awesome-icon :icon="['fas', 'file']" class="selected-file"/> -->
                <p>{{file.name?file.name:''}}</p>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props:['limit','isRequired','id'],
    data(){
        return{
            files:[]
        }
    },
    methods:{
        onChange(e){
            if(!this.limit){
                this.files.push(e.target.files[0])
            }
            else if(this.files.length < this.limit && this.limit){
                this.files.push(e.target.files[0])
            }
            this.$emit('passFiles', this.files)
        },
        remove(index){
            this.files.splice(index,1)
            this.$emit('passFiles', this.files)
        },
    }

}
</script>

<style scoped>
input{
    @apply h-full opacity-0 absolute top-0 left-0
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