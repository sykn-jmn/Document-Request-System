<template>
    <div class="sticky top-0 bg-red-700 pl-4 pr-8 flex justify-between items-center h-16 py-4 w-full">
        <div class="text-2xl">
            <font-awesome-icon :icon="['fas', 'bars']" size="lg" />
        </div>
        <div class="flex items-center">
            <img :src="getImgUrl()" class="rounded-full" width="50" height="50">
            <span class="text-xl ml-4">{{name}}</span>
        </div>
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
    methods:{
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
            const imgUrl = this.profilePicPath? require("../../server/storage/app/public/"+this.profilePicPath): require("~/assets/images/"+this.defaultPath)
        return imgUrl
      }
    }

}
</script>

<style>

</style>