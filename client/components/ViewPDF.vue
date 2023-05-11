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
  mounted(){
    
  },
  methods:{

    getLink(){
      this.$axios.get('/test/get-pdf',{responseType: 'blob'}).then(res=>{
        console.log(res)
          const blob = new Blob([res.data],{type: "application/pdf"})
          const objectUrl = window.URL.createObjectURL(blob)
          window.open(objectUrl);
      })
      
    }
  }
}
</script>

<style>

</style>