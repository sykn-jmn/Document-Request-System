<template>
  <div class="md:p-20">
    <h1>Review Before Submitting</h1>
    <p>To avoid rejection of your request, please be carefully review the details</p>
    <div class="md:flex mt-4 md:space-x-8">     
      <div class="p-8 w-full md:grid md:grid-cols-2 bg-white md:rounded-xl md:shadow-lg">
        <p class="label">Name:</p>
        <p>{{$store.state.request.request.form.name}}</p>
        <p class="label">Age:</p>
        <p>{{$store.state.request.request.form.age}}</p>
        <p class="label">Sex:</p>
        <p>{{$store.state.request.request.form.sex}}</p>
        <p class="label">Civil Status:</p>
        <p>{{$store.state.request.request.form.civil_status}}</p>
        <p class="label">Completed Address:</p>
        <p>{{$store.state.request.request.form.address}}</p>
        <p class="label">Email:</p>
        <p>{{$store.state.request.request.form.email}}</p>
        <p class="label">Mobile Number:</p>
        <p>{{$store.state.request.request.form.mobile_number}}</p>
        <p class="label">Valid ID</p>
        <p>{{$store.state.request.request.form.validIDName}}</p>
        <p class="label">Other Documents</p>
        <!-- <p>{{$store.state.request.request.form.supportingDocumentsNameName.join(", ")}}</p> -->
        <p>{{$store.state.request.request.form.supportingDocumentsName.join(", ")}}</p>
      </div>
      <div class="rounded-xl bg-white py-8 px-4 md:shadow-lg">
        <div class="flex justify-between py-4">
          <p class="font-bold">Particular(s)</p>
          <p class="font-bold">Amount</p>
        </div>
        <div class="flex justify-between" v-for="document in $store.state.request.request.selectedDocuments" :key="document.id">
          <p>{{document.name}}</p>
          <p>{{document.fee}}</p>
        </div>
        <div class="flex justify-between py-4">
          <p class="font-bold">Total</p>
          <p>{{getTotalFeeDocuments()}}</p>
        </div>
        <div class="border-t border-slate-200 py-4">
          <p class="font-bold">Pick-up Schedule</p>
          <p>{{getDate($store.state.request.request.pickUpDate.selectedDate)+" "+$store.state.request.request.pickUpDate.meridiem.toUpperCase()}}</p>
        </div>
        <div class="border-t border-slate-200">
          <p><span class="text-red-500 font-bold">Note: </span>Payment can be made upon claiming your requested document at the baranggay office.</p>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import moment from 'moment'
export default {

  mounted(){
    console.log(this.$store.state.request.request)
  },
  methods:{
    getTotalFeeDocuments(){
      let total = parseFloat(0.00)
      this.$store.state.request.request.selectedDocuments.forEach(document=>{
        total = total + parseFloat(document.fee)
      })
      return total.toFixed(2)
    },
    getDate(date){
      return moment(date).format("dddd, MMMM DD, yyyy")
    }
  },
}
</script>

<style scoped>
.label{
  @apply font-bold
}

</style>