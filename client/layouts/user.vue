<template>
  <div class="user_layout flex w-full min-h-screen bg-green-100">
      <NavUser />
      <div class="w-full h-full">
        <HeaderUser />
        <slot />
      </div>
      
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>