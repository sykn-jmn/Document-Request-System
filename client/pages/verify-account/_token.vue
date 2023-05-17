<template>
    <div class="flex flex-col min-h-screen justify-between">
        <AppHeader />
        <div>
            <div class="text-container bg-green-500" v-if="isVerified">
                Verified Successfully!
            </div>
            <div class="text-container bg-red-500" v-else>
                Sorry your token does not exist
            </div><br>
            <h1 class="text-center text-xl">
                <NuxtLink to="/">Go to login page</NuxtLink>
            </h1>
        </div>
        <AppFooter />
        <Spin v-if="spinning"/>
    </div>
</template>

<script>
export default {
    data(){
        return{
            isVerified:false,
            spinning:false,
        }
    },
    mounted(){
        this.spinning = true
        var params = {
            token: this.$route.params.token
        }
        this.$axios.put('/user/verify-account',params).then(response=>{
            this.isVerified = response.data.isVerified
            this.spinning = false
        }).catch(err=>{
            this.spinning = false
        })
    }
}
</script>

<style scoped>
.text-container{
    @apply text-3xl text-center w-fit m-auto mt-0 p-8 rounded-2xl shadow-xl
}
h1{
    @apply hover:text-blue-500
}

</style>