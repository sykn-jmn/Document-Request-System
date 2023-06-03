<template>
<div class="modal">
    <button @click="generatePDF">Generate PDF</button>
    <div id="content" class="">
        <!-- <barangayClearance /> -->
        <!-- <BarangayPermit /> -->
        <!-- <BarangayCertificateIndigency/> -->
        <!-- <barangayClearanceBusiness /> -->
        <BarangayCertificateResidency v-show="true"/>
        <Spin v-if="spinning"/>
    </div>
</div>

</template>

<script>
import jsPDF from'jspdf'
export default {
    data(){
        return{
            spinning:false,
        }
    },
mounted(){

},

methods:{
    async generatePDF(){
        this.spinning =  true
        const doc = new jsPDF(undefined, undefined, 'a4');
        var elementHTML = document.getElementById("content");

        await doc.html(elementHTML, {
            callback: function(doc) {
                // Save the PDF
                const pdfBlob = doc.output('blob');
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl,'_blank');
                
            },
            x: 0,
            y: 0,
            width: 171,
            windowWidth: 650
        });
        this.spinning=false 
    },
    
}


}
</script>

<style scoped>
#content{
    width:210mm;
    height:297mm;
    font-family: "Times New Roman", Times, serif;
    @apply text-center text-black m-auto relative
}

</style>