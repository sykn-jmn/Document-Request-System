<template>
  <div>
    <div class="header-calendar">
      <button @click="prev"><font-awesome-icon :icon="['fas', 'chevron-left']" /></button>
      <h1>{{monthName}}</h1>
      <button @click="next"><font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
      <h1>{{year}}</h1>
    </div>
    <ul class="grid grid-cols-7">
      <li>Sunday</li>
      <li>Monday</li>
      <li>Tuesday</li>
      <li>Wednesday</li>
      <li>Thursday</li>
      <li>Friday</li>
      <li>Saturday</li>
      <li v-for="(n,i) in 42" :key="i" >
        <span v-if="0<i-startDay && i-startDay<=endDate">{{i-startDay}}</span>
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
  @apply text-center border border-black
}
li{
  @apply border border-black
}
h1{
  @apply text-3xl font-bold
}

</style>