<template>
  <div class="account-information">
      <div class="photo">
        <img class="rounded-full w-40 h-40 m-auto" src="~/assets/images/no_profile_pic.jpg">
        <div class="button-wrapper">
          <button>Upload New Photo</button>
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
        user:this.$auth.state.user
      }
    },
    methods:{
      registrationDate(){
          return moment(this.$auth.$state.user.created_at).format('MMMM d, YYYY');
      }
    }
}
</script>

<style scoped>
.account-information{
  @apply flex bg-white py-8 px-16 rounded-xl shadow-lg
}

.button-wrapper{
  @apply text-white w-full text-center text-base
}
.button-wrapper > button{
  @apply py-1 px-4 bg-yellow-400 w-full rounded-lg
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

</style>