<template>
  <div>
    <div id = "content" class="bg-blue-900 text-center bg-white text-black m-auto py-8">
        <div class="flex items-center m-auto justify-around">
            <img src="~/assets/images/Maranding_Logo.png" width="150" height="150"/>
            <div class="text-lg">
                <p>Republic of the Philippines</p>
                <p>Province of Lanao Del Norte</p>
                <p>Municipality of<b> Lala</b></p>
                <p>Baranggay <b>Maranding</b></p>
            </div>
            <img src="~/assets/images/Maranding_Logo.png" width="150" height="150"/>
        </div><br>
        <h1>Baranggay Permit</h1><br><br>
        <div class="grid grid-cols-3">
            <div class="text-sm">
                <div class="par">
                    <p class="officials_name">Hon. Jeoffy M.Fung</p>
                    <p>Punong Baranggay</p>
                    <p>Commitee on Transportation,Peace and Order, Disaster Risk Reduction and Management</p>
                </div><br>
                <div class="par">
                    <p class="officials_name">Hon. Graciano S. Termis Jr.</p>
                    <p>Punong Baranggay</p>
                    <p>Commitee on Agriculture &amp; on Environmental Management and Solid Waste Management</p>
                </div>
            </div>
            <div class="col-span-2">
                hiii
            </div>
        </div>
    </div>
    <button @click="generatePDF">Generate PDF</button>
    <Spin v-if="spinning"/>
  </div>
</template>

<script>
import jsPDF from'jspdf'
export default {
    data(){
        return{
            spinning:false
        }
    },

methods:{
    async generatePDF(){
        this.spinning =  true
        const doc = new jsPDF(undefined, undefined, 'a4');
        var elementHTML = document.querySelector("#content");

        await doc.html(elementHTML, {
            callback: function(doc) {
                // Save the PDF
                const pdfBlob = doc.output('blob');
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl,'_blank');
                
            },
            x: 0,
            y: 0,
            width: 170, //target width in the PDF document
            windowWidth: 650 //window width in CSS pixels
        });
        this.spinning=false
        
    }
}


}
</script>

<style scoped>
#content{
    width:210mm;
    height:297mm;
    font-family: "Times New Roman", Times, serif;
}
.officials_name{
    @apply font-semibold text-sky-700
}
h1{
    font-size:45px;
    @apply font-bold
}
.par{
    @apply w-56 m-auto; 
}
</style>