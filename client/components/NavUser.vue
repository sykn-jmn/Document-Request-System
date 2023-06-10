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
                <li><button @click="$router.push('/user/dashboard')" class="nav_link"><span><font-awesome-icon :icon="['fas', 'table-list']" /></span>Dashboard</button></li>
                <li><button @click="$router.push('/user/request')" class="nav_link"><span><font-awesome-icon :icon="['fas', 'file-invoice']" /></span>Request Document</button></li>
                <li><button @click="$router.push('/user/request-history/all')" class="nav_link"><span><font-awesome-icon :icon="['fas', 'clock-rotate-left']" /></span>Request History</button></li>
                <li><button @click="$router.push('/user/account')" class="nav_link"><span><font-awesome-icon :icon="['fas', 'user']" /></span>Account</button></li>
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
            profilePicPath:"",
            defaultPath:"",
        }
    },
    mounted(){
        this.getProfilePicture()
    },
    methods: {
        async logout() {
            await this.$auth.logout().then(response=>{
                    this.$router.push('/')
                } 
            )
        },
        async getProfilePicture(){
            await this.$axios.get('/user/profile-pic').then(response=>{
                    this.profilePicPath = response.data.path
                }
            )
        },
        getImgUrl(){
            if(this.$auth.$state.user.sex == 'male'){
                this.defaultPath = "Male_Icon.png"
            }else{
                this.defaultPath = "Female_Icon.png"
            }
            const imgUrl = this.profilePicPath? require("../storage/app/public/"+this.profilePicPath): require("~/assets/images/"+this.defaultPath)
        return imgUrl
      }
    },
}
</script>

<style scoped>
.nav_link{
    @apply w-full h-full text-left focus:bg-stone-900
}

</style>