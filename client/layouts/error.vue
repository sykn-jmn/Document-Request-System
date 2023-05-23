<template>
  <div class="bg-white w-screen h-screen text-center md:pt-32 p-8">
    <div class="p-8 bg-red-700 text-white m-auto md:py-16 py-8">
      <h1 v-if="error.statusCode === 404">Page not found</h1>
      <h1 v-else>An error occurred</h1><br>
      <div class="m-auto w-fit">
        <font-awesome-icon :icon="['fas', 'person-circle-question']" class="missing" />
      </div><br>
      <NuxtLink to="/admin/dashboard" v-if="$store.state.auth.strategy == 'adminAuth'" class="link">Go back to homepage</NuxtLink>
      <NuxtLink to="/user/dashboard" v-else class="link">Go back to homepage</NuxtLink>
      </div>
  </div>
</template>

<script>
  export default {
    props: ['error'],
    layout: 'error' // you can set a custom layout for the error page
  }
</script>
<style scoped>
.missing{
  font-size:250px;
  @apply text-center
}
h1{
  @apply text-2xl font-bold
}
.link{
  @apply text-lg font-semibold
}
</style>