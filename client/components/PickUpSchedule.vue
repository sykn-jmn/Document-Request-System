<template>
  <div class="w-fit m-auto">
    <div class="header-calendar">
      <button @click="prev"><font-awesome-icon :icon="['fas', 'chevron-left']" /></button>
      <h1>{{monthName}}</h1>
      <button @click="next"><font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
      <h1>{{year}}</h1>
    </div>
    <ul class="grid grid-cols-7">
      <li class="weekdays">Sunday</li>
      <li class="weekdays">Monday</li>
      <li class="weekdays">Tuesday</li>
      <li class="weekdays">Wednesday</li>
      <li class="weekdays">Thursday</li>
      <li class="weekdays">Friday</li>
      <li class="weekdays">Saturday</li>
      <li class="date" v-for="(n,i) in 42" :key="i" >
        <div v-if="0<i-dayToMinus && i-dayToMinus<=endDate" class="w-full">
          <p class="date-number">{{i-dayToMinus}}</p>
          <div v-if="(i+1) % 7 != 0 && (i+1) % 7 != 1 && !holidays[month].includes(i-dayToMinus) && i-dayToMinus>currentDate">
              <button @click="selectedDate(i-dayToMinus,'am')">AM {{getSlots(i-dayToMinus, 'am')}} slots</button>
              <button @click="selectedDate(i-dayToMinus,'pm')">PM {{getSlots(i-dayToMinus, 'pm')}} slots</button>
          </div>
          <div v-else>
              <font-awesome-icon :icon="['fas', 'ban']" class="na-icon"/>
              <p class="na-message">Not Applicable</p>
          </div>
        </div>
      </li>
    </ul>
    <p class="error">{{error}}</p>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  props:["error"],
  data(){
    return{
      monthName:'',
      currentDate: new Date().getDate(),
      startDay:0,
      dayToMinus:0,
      endDate:0,
      year: new Date().getFullYear(),
      month: new Date().getMonth(),
      countDate:0,
      holidays:[[1],[],[],[6,7,10,21],[1],[12],[],[28],[],[],[27],[25,30]],
      appointments:[],
    }
  },
  mounted(){
    this.renderCalendar(this.year, this.month)
    this.getAppointments(this.month)
  },
  methods:{
    renderCalendar(year, month){
      this.monthName = moment(month+1, 'MM').format('MMMM')
      this.endDate = new Date(year, month+1, 0).getDate()
      this.startDay = new Date(year, month, 1).getDay()
      this.dayToMinus = this.startDay-1
    },
    next(){
      if(this.month==11){
        this.month = 0
        this.year++
      }else{
        this.month++
      }
      this.renderCalendar(this.year, this.month)
      this.getAppointments()
    },
    prev(){
      if(this.month==0){
        this.month = 11
        this.year--
      }else{
        this.month--
      }
      this.renderCalendar(this.year, this.month)
      this.getAppointments()
    },
    async getAppointments(){
      var params = {
        startDate: moment(new Date(this.year, this.month, this.startDay)).format('yyyy-MM-DD'),
        endDate: moment(new Date(this.year, this.month, this.endDate)).format('yyyy-MM-DD'),
      }
      await this.$axios.get('/user/request/get-slots', {params}).then(response=>{
        this.appointments = response.data
      })
    },
    getSlots(day, meridiem){
      let date = moment(new Date(this.year, this.month, day)).format('yyyy-MM-DD')
      let filterAppointment = this.appointments.filter(appointment=>appointment.schedule == date && appointment.meridiem == meridiem)

      let slots = 100 - filterAppointment.length
      return slots
    },
    selectedDate(day,meridiem){
      let dateClicked={
        selectedDate:moment(new Date(this.year,this.month, day)).format('yyyy-MM-DD'),
        meridiem:meridiem
      } 
      this.$store.commit('request/updatePickUpDate', {
          pickUpDate: dateClicked,
      });
    }
  }

}
</script>

<style scoped>
h1{
  @apply text-3xl font-bold
}
.header-calendar{
  @apply flex w-fit
}
.header-calendar > button{
  @apply px-4
}
ul{
  @apply text-center border border-black w-fit m-auto
}
li{
  @apply border border-black
}
.date-number{
  @apply text-right w-full text-cyan-700 text-lg font-medium mr-2 pr-2
}
.weekdays{
  @apply h-fit bg-sky-700 text-white p-2
}
.date{
  @apply w-32 h-32 relative
}

.date > div> div> button{
  @apply text-center bg-blue-400 text-white rounded-md p-2 mb-2 focus:bg-sky-900
}
.na-icon{
  @apply md:text-3xl text-red-600
}
.na-message{
  @apply text-red-600
}
</style>