<template>
  <div class="modal">
    <div class="content">
        <PickUpSchedule />
        <div class="w-fit m-auto flex space-x-4 mt-10">
            <button class="bg-slate-300 status-button text-black py-2 w-32" @click="$emit('close')">Cancel</button>
            <button class="bg-blue-500 status-button text-white py-2 w-32" @click="$emit('resched')">Save</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>