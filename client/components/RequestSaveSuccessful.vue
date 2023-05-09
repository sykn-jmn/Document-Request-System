<template>
  <div class="container">
    <h1>Request Submitted</h1><br>
    <font-awesome-icon :icon="['fas', 'circle-check']" class="check-icon"/><br><br>
    <p>Your request has been submitted!</p>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
h1{
  @apply text-sky-900 text-3xl font-bold
}
p{
  @apply text-slate-500
}
.container{
  @apply m-auto w-fit text-center md:mt-48
}
.check-icon{
  font-size:100px;
  @apply text-sky-900
}
</style>