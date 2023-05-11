<template>
  <div>
    <button @click="getLink">click</button>
  </div>
</template>

<script>
export default {
  data(){
    return{
      pdfsrc:''
    }
  },
  methods:{
    getLink(){
      const blob = new Blob(['../../server/storage/app/public/supporting_documents/1683726470_loh.pdf'],{type: "application/pdf"})
      const objectUrl = window.URL.createObjectURL(blob)
      this.pdfsrc = objectUrl
      window.open(objectUrl);
    }
  }
}
</script>

<style>

</style>