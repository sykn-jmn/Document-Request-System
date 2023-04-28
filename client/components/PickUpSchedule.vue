<template>
  <div>
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
          <div v-if="i+1%7!=0">
              <button>AM 100 slots</button>
              <button>PM 100 slots</button>
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
    }
  }

}
</script>

<style scoped>
.header-calendar{
  @apply flex
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
  @apply text-right w-full text-cyan-700 text-lg font-medium
}
.weekdays{
  @apply h-fit bg-sky-700 text-white p-2
}
.date{
  @apply w-32 relative
}

.date > div> div>button{
  @apply text-center bg-blue-400 text-white rounded-md p-2 mb-2
}
</style>