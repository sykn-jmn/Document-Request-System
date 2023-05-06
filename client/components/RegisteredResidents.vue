<template>
    <div class="pt-8 px-16 bg-white rounded-2xl">
        <div class="flex justify-between items-center">
            <div class="p-4 rounded-full bg-orange-500">
                <font-awesome-icon :icon="['fas', 'user']" style="color: #ffffff;" class="icon"/>
            </div>
            <div class="text-xl text-slate-500">
                <p>Registered</p>
                <p>Residents</p>
            </div>
            <span class="text-3xl font-bold">{{countResidents}}</span>
        </div>
        <div class="mt-8 border-t border-slate-300 p-4 h-fit">
            <p class="text-center text-blue-500 font-semibold text-xl">See All</p>
        </div>

    </div>
</template>

<script>
export default {
    data(){
        return{
            countResidents:2250,
        }
    }
}
</script>

<style scoped>
.icon{
    font-size:30px;
}

</style>