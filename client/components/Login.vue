<template>
  <div class="form-wrapper">
    <form class="login-form">
      <h1>Log In To Your Account</h1><br><br>
      <input type="text" id="username" name="username" placeholder="Username"><br><br>
      <input type="text" id="username" name="username" placeholder="Password"><br><br>
      <p class="text-center text-sky-600"><NuxtLink to="https://nuxtjs.org">Forgot your password?</NuxtLink></p><br><br>
      <div class="button-wrapper text-center">
          <button class="py-4 bg-yellow-400 rounded-full w-2/3 m-auto font-bold text-white">LOGIN</button>
      </div><br><br>
      <p class="text-center text-sky-600">Don't have an account? <span class="underline font-bold"><NuxtLink to="https://nuxtjs.org">Signup</NuxtLink></span></p>
    </form>
  </div>
</template>

<script>
export default {

  setup(){

  }

}
</script>

<style>

</style>