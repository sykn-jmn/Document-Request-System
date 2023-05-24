<template>
  <div class="modal">
    <div class="content">
        <PickUpSchedule /><br>
        <div class="m-auto w-fit space-x-8">
          <button class="bg-slate-200 w-32 py-2" @click="$emit('close')">Cancel</button>
          <button class="bg-blue-500 w-32 py-2 text-white" @click="$emit('updateSched')">Update</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>