<template>
  <div class="user_layout flex w-full min-h-screen bg-slate-100 relative">
      <NavUser />
      <div class="w-full h-full">
        <HeaderUser />
        <Nuxt />
      </div>
      <UpdateRequiredModal  v-if="updateRequired" @close="updateRequired = false"/>
  </div>
</template>

<script>
export default {
    middleware:['auth','user'],
    data(){
      return{
        updateRequired:false
      }
    },
    methods:{
      async getUserData(){
            await this.$axios.get('/user/get-details/').then(response=>{
                let user = response.data
                if(!user.first_name || !user.middle_name || !user.last_name || !user.sex || !user.civil_status || !user.birthdate || !user.birthplace || !user.religion || !user.citizenship || !user.purok || !user.barangay || !user.municipality || !user.province || !user.mobile_number || !user.email || !user.mothers_firstname || !user.mothers_middlename || !user.mothers_lastname || !user.fathers_firstname || !user.fathers_middlename || !user.fathers_lastname){
                    this.updateRequired = true
                }
            })
        },
    }

}
</script>

<style>

</style>