<template>
    <div>
        <AppHeader />
        <div class="text-container" v-if="isVerified">
            Verified Successfully!
        </div>
        <div class="text-container" v-else>
            Sorry your token does not exist
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            isVerified:false
        }
    },
    mounted(){
        this.$axios.put('/verify-account/' + this.$route.params.token).then(response=>{
            this.isVerified = response.data.isVerified
        })
    }
}
</script>

<style scoped>
.text-container{
    @apply text-3xl text-center top-1/2 bg-sky-900 w-fit m-auto p-8 rounded-2xl mt-48 shadow-xl
}

</style>