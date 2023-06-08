<template>
  <div id="pdf-content">

    <button @click="generatePDF">Generate PDF</button>
  </div>
  
  
</template>

<script>
import jsPDF from 'jspdf';
import imageBase64 from '~/assets/images/Maranding_Logo.png';
export default {
  mounted(){
    this.$axios.post('/stored')
  }
}
</script>

<style scoped>
 
</style>