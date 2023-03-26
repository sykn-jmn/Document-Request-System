<template>
    <div class="sticky top-0 h-full">
        <nav class="navUser h-full">
            <div class="nav_profile text-center text-xl">
                <img class="rounded-full w-48 h-48 m-auto" src="~/assets/images/id_nako.jpg"><br>
                <span>Jhumer Apus</span>
            </div><br>
            <ul>
                <li><NuxtLink to="user/dashboard" class="nav_link"><span><font-awesome-icon :icon="['fas', 'table-list']" /></span>Dashboard</NuxtLink></li>
                <li><NuxtLink to="user/request-document" class="nav_link"><span><font-awesome-icon :icon="['fas', 'file-invoice']" /></span>Request Document</NuxtLink></li>
                <li><NuxtLink to="user/request-history" class="nav_link"><span><font-awesome-icon :icon="['fas', 'clock-rotate-left']" /></span>Request Hsitory</NuxtLink></li>
                <li><NuxtLink to="user/account" class="nav_link"><span><font-awesome-icon :icon="['fas', 'user']" /></span>Account</NuxtLink></li>
                <li class="pl-12 py-4 hover:bg-stone-900"><span class="mr-4"><font-awesome-icon :icon="['fas', 'power-off']" /></span>Logout</li>
            </ul>
        </nav>
    </div>  
</template>

<script lang="ts">
export default {

}
</script>

<style>

</style>