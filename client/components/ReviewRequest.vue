<template>
  <div class="md:p-20">
    <h1>Review Before Submitting</h1>
    <p>To avoid rejection of your request, please be carefully review the details</p>
    <div class="md:flex mt-4 md:space-x-8">     
      <div class="p-8 w-full md:grid md:grid-cols-2 bg-white md:rounded-xl md:shadow-lg">
        <p class="label">Name:</p>
        <p>{{$store.state.request.form.name}}</p>
        <p class="label">Age:</p>
        <p>{{$store.state.request.form.age}}</p>
        <p class="label">Sex:</p>
        <p>{{$store.state.request.form.sex}}</p>
        <p class="label">Civil Status:</p>
        <p>{{$store.state.request.form.civil_status}}</p>
        <p class="label">Completed Address:</p>
        <p>{{$store.state.request.form.address}}</p>
        <p class="label">Email:</p>
        <p>{{$store.state.request.form.email}}</p>
        <p class="label">Mobile Number:</p>
        <p>{{$store.state.request.form.mobile_number}}</p>
        <p class="label">Valid ID</p>
        <p>{{$store.state.request.validIDName}}</p>
        <p class="label">Other Documents</p>
        <p>{{$store.state.request.supportingDocumentsName?$store.state.request.supportingDocumentsName.join(", "):""}}</p>
      </div>
      <div class="rounded-xl bg-white py-8 px-4 md:shadow-lg">
        <div class="flex justify-between py-4">
          <p class="font-bold">Particular(s)</p>
          <p class="font-bold">Amount</p>
        </div>
        <div class="flex justify-between">
          <p>{{$store.state.request.selectedDocument.name}}</p>
          <p>{{$store.state.request.selectedDocument.fee}}</p>
        </div>
        <div class="flex justify-between py-4">
          <p class="font-bold">Total</p>
          <p>{{getFeeDocument()}}</p>
        </div>
        <div class="border-t border-slate-200 py-4">
          <p class="font-bold">Pick-up Schedule</p>
          <p>{{getDate($store.state.request.selectedDate)+" "+$store.state.request.meridiem.toUpperCase()}}</p>
        </div>
        <div class="border-t border-slate-200">
          <p><span class="text-red-500 font-bold">Note: </span>Payment can be made upon claiming your requested document at the barangay office.</p>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import moment from 'moment'
export default {

  methods:{
    getFeeDocument(){
      // let total = parseFloat(0.00)
      // this.$store.state.request.selectedDocuments.forEach(document=>{
      //   total = total + parseFloat(document.fee)
      // })
      let fee = parseFloat(this.$store.state.request.selectedDocument.fee);
      this.$store.commit('request/updateFee', {
          fee: fee.toFixed(2)
      });
      return fee.toFixed(2)
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
h1{
  @apply text-sky-900 text-3xl font-bold
}

</style>