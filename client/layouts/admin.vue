<template>
  <div class="user_layout flex w-full min-h-screen bg-slate-100 relative">
      <NavAdmin />
      <div class="w-full h-full">
        <HeaderAdmin />
        <Nuxt />
      </div>
  </div>
</template>

<script>
export default {
    middleware:['auth','admin'],

}
</script>

<style>

</style>