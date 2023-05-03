<template>
  <div class="user_layout flex w-full min-h-screen bg-slate-100 relative">
      <NavUser />
      <div class="w-full h-full">
        <HeaderUser />
        <Nuxt />
      </div>
  </div>
</template>

<script>
export default {
    middleware:['auth','user'],

}
</script>

<style>

</style>