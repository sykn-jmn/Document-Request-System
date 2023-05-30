<template>
  <div id="pdf-content">
    <!-- Other content goes here -->
    <button @click="generatePDF">Generate PDF</button>
  </div>
  
  
</template>

<script>
import jsPDF from 'jspdf';
import imageBase64 from '~/assets/images/Maranding_Logo.png';
export default {
    methods: {
      generatePDF() {
        const pdf = new jsPDF({
        format: 'a4' // Set the document format to A4
      });
        const imageURL = '~/assets/images/Maranding_Logo.png';

        let nectColumn = 30
        let x = 30;
        let y = 20;

        pdf.setFontSize(14)
        pdf.setFont('Times New Roman')
        
        pdf.text( 'Republic of the Philippines', 75,y)
        y+=7
        pdf.text( 'Province of Lanao Del Norte', 74,y)
        y+=7
        pdf.text( 'Municipality of Lala', 84,y)
        y+=7
        pdf.text( 'Baranggay Maranding', 80,y)
        y+=20


        pdf.setFontSize(22)
        pdf.setFont(undefined,'bold')
        pdf.text( 'BARANGGAY CLEARANCE',50,y)
        y += 8
        pdf.text( '(BUSINESS)',80,y)

        pdf.setFontSize(10)
        pdf.setFont(undefined,'normal')
        y += 30

        pdf.setFont(undefined,'bold')
        let text_a = 'Hon. Jeoffy M. Fung'
        let lineWidth_a = pdf.getTextWidth(text_a)
        pdf.text(text_a,x,y)
        pdf.line(x, y+1, x+lineWidth_a, y+1)
        y += 5
        pdf.setFont(undefined,'normal')

        pdf.text( 'Punong Baranggay',33,y)


        pdf.setFont(undefined,'normal')
        const pdfBlob = pdf.output('blob');
        const pdfUrl = URL.createObjectURL(pdfBlob);
        window.open(pdfUrl,'_blank');
      
        // Open the PDF in a new window/tab
        // window.open(pdfDataUri, '_blank');
      }
    }
  }
</script>

<style scoped>
 
</style>