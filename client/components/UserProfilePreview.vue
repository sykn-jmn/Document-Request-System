<template>
  <div class="account-information">
      <div class="photo">
        <img class="rounded-full w-40 h-40 m-auto" :src="getImgUrl()">
        <div class="button-wrapper">
          <label for="uploadPhoto">Upload New Photo</label>
          <input class="upload-photo" type="file" accept="image/png, image/jpg, image/jpeg" v-on:change="uploadPhoto" id="uploadPhoto">
          <!-- <button>Upload New Photo</button> -->
        </div>
      </div>
      <div class="details-wrapper">
        <h2 class="font-bold text-2xl">{{fullName.toUpperCase()}}</h2><br>
        <div class="contact-wrapper">
          <font-awesome-icon :icon="['fas', 'envelope']" />
          <p>{{user.email}}</p>
        </div>
        <div class="contact-wrapper">
          <font-awesome-icon :icon="['fas', 'phone']" />
          <p>{{user.mobile_number}}</p>
        </div>
        <div class="contact-wrapper">
          <font-awesome-icon :icon="['fas', 'location-dot']" />
          <p>aasdasdsadsd</p>         
        </div><br><br>
        <p>Registration Date: <span class="font-medium">{{registrationDate()}}</span></p>
      </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    data(){
      return{
        fullName:this.$auth.state.user.first_name + " " + this.$auth.state.user.middle_name + " " + this.$auth.state.user.last_name,
        user:this.$auth.state.user,
        file:"",
        profilePicPath:"",
        defaultPath:"",
      }
    },
    mounted(){
      this.getProfilePicture()
    },
    methods:{
      registrationDate(){
          return moment(this.$auth.$state.user.created_at).format('MMMM d, YYYY');
      },
      uploadPhoto(e){
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
          }
        this.file = e.target.files[0]
        let formData = new FormData()
        formData.append("file", this.file)

        this.$axios.post('/admin/account/upload-photo',formData,config).then(response=>{
        }).catch(err=>console.log(err))
      },
      async getProfilePicture(){
        await this.$axios.get('/admin/profile-pic').then(response=>{
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
          let imgUrl = this.profilePicPath? require("../../server/storage/app/public/"+this.profilePicPath): require("~/assets/images/"+this.defaultPath)
        return imgUrl
      }
    }
}
</script>

<style scoped>
.account-information{
  @apply flex bg-white py-8 px-16 rounded-xl shadow-lg
}

.button-wrapper{
  @apply text-white w-48 text-center text-base
}
.button-wrapper > label{
  @apply py-2 px-4 bg-red-600 w-full rounded-lg cursor-pointer
}

.details-wrapper{
  @apply ml-24
}
.contact-wrapper{
  @apply flex items-center space-x-4 font-medium
}
.photo{
    @apply w-fit
}
.upload-photo{
  @apply hidden
}

</style>