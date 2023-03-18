<template>
  <div class="header">
    <div>
        <h1 class="text-2xl">eDokumento</h1>
    </div>
    <nav>
        <ul>
            <li><NuxtLink to="https://nuxtjs.org">Home</NuxtLink></li>
            <li><NuxtLink to="https://nuxtjs.org">About </NuxtLink></li>
            <li><NuxtLink to="https://nuxtjs.org">Services</NuxtLink></li>
        </ul>
    </nav>
  </div>
</template>

<script lang="ts">
import {reactive} from 'vue'
export default {
    setup(){
        const data = reactive({
            
        })
    }
}
</script>

<style>

</style>