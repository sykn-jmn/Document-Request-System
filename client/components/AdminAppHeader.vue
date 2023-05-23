<template>
  <div class="header">
    <div class=title>
        <img src="~assets/images/Asset 13.png" width="200" height="200"/>
    </div>
    <nav class="navHome">
        <ul>
            <li><NuxtLink to="admin">Home</NuxtLink></li>
            <li><NuxtLink to="about">About </NuxtLink></li>
            <li><NuxtLink to="services">Services</NuxtLink></li>
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
    mounted(){
    }
}
</script>

<style>

</style>