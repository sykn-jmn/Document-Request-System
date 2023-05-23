<template>
    <div class="sticky top-0 h-screen">
        <div class="nav_header">
            <img src="~assets/images/Asset 13.png" width="200" height="200" class="m-auto"/>
        </div>
        <nav class="navUser">
            <div class="nav_profile text-center text-xl">
                <img class="rounded-full w-48 h-48 m-auto" :src="getImgUrl()"><br>
                <span>{{name}}</span>
            </div><br>
            <ul>
                <li><NuxtLink to="/admin/dashboard" class="nav_link"><span><font-awesome-icon :icon="['fas', 'table-list']" /></span>Dashboard</NuxtLink></li>
                <li><NuxtLink to="/admin/request-management/pending" class="nav_link"><span><font-awesome-icon :icon="['fas', 'file-invoice']" /></span>Request Management</NuxtLink></li>
                <li><NuxtLink to="/admin/recent-activities" class="nav_link"><span><font-awesome-icon :icon="['fas', 'clock-rotate-left']" /></span>Recent Activity</NuxtLink></li>
                <li><NuxtLink to="/admin/account" class="nav_link"><span><font-awesome-icon :icon="['fas', 'user']" /></span>Account</NuxtLink></li>
                <li class="pl-12 py-4 hover:bg-stone-900 cursor-pointer" @click="logout"><span class="mr-4"><font-awesome-icon :icon="['fas', 'power-off']" /></span>Logout</li>
            </ul>
        </nav>
    </div>  
</template>

<script>
export default {
    data(){
        return{
            name: this.$auth.state.user.first_name + " " + this.$auth.state.user.last_name,
            profilePicPath:""
        }
    },
    mounted(){
        this.getProfilePicture()
        console.log('hi')
        console.log(this.$auth.state)
    },
    methods: {
        async logout() {
            await this.$auth.logout().then(response=>{
                    this.$router.push('/admin')
                }
            )
        },
        async getProfilePicture(){
            await this.$axios.get('/admin/profile-pic').then(response=>{
                    this.profilePicPath = response.data.path
                }
            )
        },
        getImgUrl(){
            const imgUrl = this.profilePicPath? require("../../server/storage/app/public/"+this.profilePicPath): require("~/assets/images/Maranding_Logo.png")
        return imgUrl
      }
    },
}
</script>

<style scoped>
.nav_link{
    @apply w-full h-full
}

</style>