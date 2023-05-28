<template>
  <div class="modal">
    <form class="content">
        <div>
          <h1>Submit your missing document</h1>
          <p>Comments: {{comments}}</p>
          <UploadFiles :isRequired="true" id="forMissingDocument"/>
        </div><br><br>
        <div class="w-fit m-auto space-x-4">
            <button @click="$emit('close')" class="bg-slate-300 text-black  w-32 py-2">Cancel</button>
            <button class="bg-blue-500 text-white w-32 py-2">Submit</button>
        </div>
    </form>
  </div>
</template>

<script>
export default {
    props:['comments'],
    data(){
        return{

        }
    },
    methods:{

    }
}
</script>

<style scoped>

</style>