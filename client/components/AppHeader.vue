<template>
  <div class="header">
    <div class=title>
        <h1 class="text-2xl">{{appName}}</h1>
    </div>
    <nav class="navHome">
        <ul>
            <li><NuxtLink to="https://nuxtjs.org">Home</NuxtLink></li>
            <li><NuxtLink to="https://nuxtjs.org">About </NuxtLink></li>
            <li><NuxtLink to="https://nuxtjs.org">Services</NuxtLink></li>
        </ul>
    </nav>
    <p class="signup font-bold">
        <NuxtLink to="/register">Signup</NuxtLink>
    </p>
  </div>
</template>

<script>
export default {
    computed: {
        appName() {
            return process.env.NUXT_ENV_APP_NAME;
        },
    },
}
</script>

<style>

</style>