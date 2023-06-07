<template>
  <div class="modal">
    <div class="bg-white px-8 py-16 m-auto rounded-xl">
        <h1 class="text-center text-black">Update Required</h1><br>
        <div class="w-fit m-auto">
            <font-awesome-icon :icon="['fas', 'circle-exclamation']" class="icon"/>
        </div><br>
        <p class="text-slate-500">Update your account Information to continue using eDokumento</p><br>
        <div class="w-fit m-auto">
            <button class="bg-red-600 text-white py-2 w-56 rounded-md" @click="goToAccount">Update Now</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    methods:{
        goToAccount(){
            this.$router.push('/user/account')
            this.$emit('close')
        }
    }
}
</script>

<style scoped>
h1{
    @apply text-3xl font-bold
}
.icon{
    font-size:100px;
    @apply text-green-500
}

</style>