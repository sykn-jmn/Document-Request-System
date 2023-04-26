<template>
    <div class="sticky top-0 h-screen">
        <div class="nav_header">
            <h1 class="text-2xl text-center">{{$config.appName}}</h1>
        </div>
        <nav class="navUser">
            <div class="nav_profile text-center text-xl">
                <img class="rounded-full w-48 h-48 m-auto" src="~/assets/images/no_profile_pic.jpg"><br>
                <span>{{name}}</span>
            </div><br>
            <ul>
                <li><NuxtLink to="/user/dashboard" class="nav_link"><span><font-awesome-icon :icon="['fas', 'table-list']" /></span>Dashboard</NuxtLink></li>
                <li><NuxtLink to="/user/request" class="nav_link"><span><font-awesome-icon :icon="['fas', 'file-invoice']" /></span>Request Document</NuxtLink></li>
                <li><NuxtLink to="/user/request-history/all" class="nav_link"><span><font-awesome-icon :icon="['fas', 'clock-rotate-left']" /></span>Request Hsitory</NuxtLink></li>
                <li><NuxtLink to="/user/account" class="nav_link"><span><font-awesome-icon :icon="['fas', 'user']" /></span>Account</NuxtLink></li>
                <li class="pl-12 py-4 hover:bg-stone-900" @click="logout"><span class="mr-4"><font-awesome-icon :icon="['fas', 'power-off']" /></span>Logout</li>
            </ul>
        </nav>
    </div>  
</template>

<script>
export default {
    data(){
        return{
            name: this.$auth.state.user.first_name + " " + this.$auth.state.user.last_name
        }
    },
    methods: {
        async logout() {
        await this.$auth.logout()
        },
  },

}
</script>

<style scoped>
.nav_link{
    @apply w-full h-full
}

</style>