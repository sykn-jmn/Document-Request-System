<template>
    <div class="sticky top-0 bg-sky-700 pl-4 pr-8 flex justify-between items-center h-16 py-4 w-full">
        <div class="text-2xl">
            <font-awesome-icon :icon="['fas', 'bars']" size="lg" />
        </div>
        <div class="flex items-center">
            <img src="~assets/images/id_nako.jpg" class="rounded-full" width="50" height="50">
            <span class="text-xl ml-4">{{name}}</span>
        </div>
    </div>
  
</template>

<script>
export default {
    data(){
        return{
            name: this.$auth.state.user.first_name + " " + this.$auth.state.user.last_name
        }
    }

}
</script>

<style>

</style>