<template>
    <div>
        <div class="index-container">
            <div class="header">
                <div class=title>
                    <h1 class="text-2xl">{{$config.appName}}</h1>
                </div>
                <nav>
                    <ul>
                        <li><NuxtLink to="https://nuxtjs.org">Home</NuxtLink></li>
                        <li><NuxtLink to="https://nuxtjs.org">About </NuxtLink></li>
                        <li><NuxtLink to="https://nuxtjs.org">Services</NuxtLink></li>
                    </ul>
                </nav>
                <p class="signup font-bold">
                    <NuxtLink to="/registration">Signup</NuxtLink>
                </p>
            </div>
            <div class="home">
                <div class="description-title text-right">
                    <h1><span class="text-yellow-400">Make</span> your document <span class="text-yellow-400">request faster</span></h1><br>
                    <p class="font-medium">Save your time and have a hassle free request of branggay documents.</p>
                </div>
                <Login />
            </div>
        </div>
        <div class="bg-slate-200 absolute bottom-0 w-full text-center text-slate-600 py-4">
            <p>Copyright c 2023 Edokumento</p>
        </div>
    </div>
    
</template>

<script lang="ts">
import {reactive} from 'vue'
export default {
    setup(){

    }
}
</script>

<style>

</style>