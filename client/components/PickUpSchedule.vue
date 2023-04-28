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
        <div v-if="0<i-startDay && i-startDay<=endDate" class="w-full">
          <p class="date-number">{{i-startDay}}</p>
          <div v-if="(i+1) % 7 != 0 && (i+1) % 7 != 1 && !holidays[month].includes(i-startDay)">
              <button @click="selectedDate(i-startDay,'am')">AM 100 slots</button>
              <button @click="selectedDate(i-startDay,'pm')">PM 100 slots</button>
          </div>
          <div v-else>
              <font-awesome-icon :icon="['fas', 'ban']" class="na-icon"/>
              <p class="na-message">Not Applicable</p>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  data(){
    return{
      monthName:'',
      startDay:0,
      endDate:0,
      year: new Date().getFullYear(),
      month: new Date().getMonth(),
      countDate:0,
      holidays:[[1],[],[],[6,7,10,21],[1],[12],[],[28],[],[],[27],[25,30]]
    }
  },
  mounted(){
    this.renderCalendar(this.year, this.month)
  },
  methods:{
    renderCalendar(year, month){
      this.monthName = moment(month+1, 'MM').format('MMMM')
      this.endDate = new Date(year, month+1, 0).getDate()
      this.startDay = new Date(year, month, 1).getDay()-1
    },
    next(){
      if(this.month==11){
        this.month = 0
        this.year++
      }else{
        this.month++
      }
      this.renderCalendar(this.year, this.month)
    },
    prev(){
      if(this.month==0){
        this.month = 11
        this.year--
      }else{
        this.month--
      }
      this.renderCalendar(this.year, this.month)
    },
    selectedDate(){
      
    }
  }

}
</script>

<style scoped>
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
h1{
  @apply text-3xl font-bold
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