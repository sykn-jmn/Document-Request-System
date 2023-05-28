<template>
  <div class="p-8 rounded-xl bg-white">
    <div class="flex items-center justify-around">
      <hr>
      <h2>USER INFORMATION</h2>
      <hr>
    </div>
    <div class="info-box">
      <p>First Name:</p>
      <p class="font-semibold col-span-2">{{firstName}}</p>
      <p>Middle Name:</p>
      <p class="font-semibold col-span-2">{{middleName}}</p>
      <p>Last Name:</p>
      <p class="font-semibold col-span-2">{{lastName}}</p>
      <p>Suffix:</p>
      <p class="font-semibold col-span-2">{{suffix?suffix:"N/A"}}</p>
      <p>Sex/Gender:</p>
      <p class="font-semibold col-span-2">{{capitalize(sex)}}</p>
      <p>Civil Status:</p>
      <p class="font-semibold col-span-2">{{capitalize(civilStatus)}}</p>
      <p>Birthdate:</p>
      <p class="font-semibold col-span-2">{{birthdate}}</p>
      <p>Birthplace:</p>
      <p class="font-semibold col-span-2">{{birthplace}}</p>
      <p>Religion:</p>
      <p class="font-semibold col-span-2">{{religion}}</p>
      <p>Citizenship:</p>
      <p class="font-semibold col-span-2">{{citizenship}}</p>
      <p>Address:</p>
      <p class="font-semibold col-span-2">{{purok}}, {{baranggay}}, {{municipality}}, {{province}}</p><br>
    </div>
    <div class="flex items-center justify-around">
      <hr>
      <h2>CONTACT INFORMATION</h2>
      <hr>
    </div>
    <div class="info-box">
      <p>Mobile Number:</p>
      <p class="font-semibold col-span-2">{{mobileNumber}}</p>
      <p>Email:</p>
      <p class="font-semibold col-span-2">{{email}}</p>
    </div>
    <div class="flex items-center justify-around">
      <hr>
      <h2>OTHER INFORMATION</h2>
      <hr>
    </div>
    <div class="info-box">
      <p>Mother's Maiden Name:</p>
      <p class="font-semibold col-span-2">{{mothersFirstname}} {{mothersMiddlename}} {{mothersLastname}}</p>
    </div>
    <Spin v-if="spinning"/>
  </div>  
</template>

<script>
export default {
  data(){
    return{
      firstName:'',
      middleName:'',
      lastName:'',
      suffix:'',
      birthdate:'',
      birthplace:'',
      gender:'',
      sex: '',
      civilStatus:'',
      citizenship:'',
      religion:'',
      purok:'',
      baranggay:'',
      zipCode:'',
      municipality:'',
      province:'',
      email:'',
      mobileNumber:'',
      mothersLastname:'',
      mothersFirstname:'',
      mothersMiddlename:'',
      spinning:false
    }
  },
  mounted(){
    this.getUserData()
  },
  methods:{
    capitalize(word){
        return word.charAt(0).toUpperCase() + word.slice(1)
    },
    async getUserData(){
        this.spinning = true
        await this.$axios.get('/admin/get-details').then(response=>{
            this.firstName=response.data.first_name
            this.middleName=response.data.middle_name
            this.lastName=response.data.last_name
            this.birthdate=response.data.birthdate
            this.birthplace=response.data.birthplace
            this.gender=response.data.gender
            this.sex=response.data.sex
            this.civilStatus=response.data.civil_status
            this.religion=response.data.religion
            this.purok=response.data.purok
            this.citizenship=response.data.citizenship
            this.suffix=response.data.suffix
            this.baranggay=response.data.baranggay
            this.zipCode=response.data.zip_code
            this.municipality=response.data.municipality
            this.province=response.data.province
            this.email=response.data.email
            this.mobileNumber=response.data.mobile_number
            this.mothersLastname=response.data.mothers_lastname
            this.mothersFirstname=response.data.mothers_firstname
            this.mothersMiddlename=response.data.mothers_middlename
          }
        ).then(response=>{
            this.spinning = false
        }).catch(err =>{
            this.spinning = false
        })
    },  
  }
}
</script>

<style scoped>
hr{
  @apply w-2/5 text-black
}
h2{
  @apply text-center
}
.info-box{
  @apply grid grid-cols-3 pt-8 pb-16 w-3/5 text-base m-auto
}

</style>