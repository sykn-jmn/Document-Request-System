<template>
  <div class="modal">
    <div class="content text-center">
        <font-awesome-icon :icon="['fas', 'circle-exclamation']" class="warning"/><br>
        <h1>Are you sure?</h1><br>  
        <p>{{message}}</p><br>
        <div class="m-auto space-x-4">
            <button class="bg-slate-200 w-32 py-2" @click="$emit('close')">No</button>
            <button class="bg-red-500 text-white w-32 py-2" @click="$emit('delete')">Yes</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    props:['message']

}
</script>

<style scoped>
.warning{
    font-size:50px;
    @apply text-red-500
}
h1{
    @apply text-2xl font-bold
}

</style>