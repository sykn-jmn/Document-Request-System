<template>
  <div>
    <div id = "content" class="bg-blue-900 text-center bg-white text-black m-auto py-8">
        <div class="flex items-center m-auto justify-around">
            <img src="~/assets/images/Maranding_Logo.png" width="100" height="120"/>
            <div class="text-base">
                <p>Republic of the Philippines</p>
                <p>Province of Lanao Del Norte</p>
                <p>Municipality of<b> Lala</b></p>
                <p>Baranggay <b>Maranding</b></p>
            </div>
            <img src="~/assets/images/Maranding_Logo.png" width="100" height="120"/>
        </div><br>
        <h1>BARANGGAY CLEARANCE</h1><br><br>
        <div class="grid grid-cols-3 gap-x-8">
            <div class="pl-16">
                <div class="par">
                    <p class="officials_name">Hon. Jeoffy M.Fung</p>
                    <p>Punong Baranggay</p>
                    <p>Commitee on Transportation, Peace and Order, Disaster Risk Reduction and Management</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. Graciano S. Termis Jr.</p>
                    <p>Commitee on Agriculture &amp; on Environmental Management</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. Roseller S. Fiel II</p>
                    <p>Commitee on Education, Cultures and Arts, Tourism, Information and Communication Technology</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. Marites G. Procianos</p>
                    <p>Commitee on Finance, Appropriations, Ways and Means &amp; on Cooperative</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. Lucky Jade G. de Guzman</p>
                    <p>Commitee on Health, Sanitation, and Solid Waste Management</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. Arturo G. Arcillas</p>
                    <p>Commitee on Laws, Rules, Legislative Relation, Municipal and Baranggay Affairs</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. Peddy N. Baculao</p>
                    <p>Commitee on Economic Enterprises, &amp; Trade and Industry</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. Allan S Guzman</p>
                    <p>Committee on Ways and Means, Women and Children</p>
                </div>
                <div class="par">
                    <p class="officials_name">Hon. John Michael Y Quilbrance</p>
                    <p>Committee on Youth, Sports Devleopment Games and Amusement</p>
                </div>
                <div class="par">
                    <p class="officials_name">Mr. Melvin C. Rabago</p>
                    <p>Baranggay Treasurer</p>
                </div>
                <div class="par">
                    <p class="officials_name">Michelle Ann C. Masecampo</p>
                    <p>Baranggay Secretary</p>
                </div>
            </div>

            <div class="col-span-2 text-justify pr-16">
                <h2>TO WHOM IT MAY CONCERN:</h2><br>
                <p>This is to certify that {{user.call_address}}. {{user.full_name}}, {{user.age}} years old {{user.civil_status}} is a bonafide resident of {{user.purok}}, Baranggay Maranding, Lala, Lanao Del Norte.</p><br>

                <p>This certifies further that as per records available in this office, {{user.pronouns}} have never been accused of any crime involving moral turpitude nor a member to any subversive anti-government social organu=ization.</p><br>

                <p>This certification is being issued upon the request of the said interested party in connection with his/her desire to/for:</p><br>

                <p class="font-semibold">"Requirement {{user.purpose}}"</p>
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
            spinning:false,
            user:{
                full_name: 'Jhumer Ojales Apus',
                age:'23',
                sex: 'male',
                civil_status:'single',
                call_address:'Mr.',
                purok:'Purok-9',
                pronouns:'he',
                purpose:'scholarship'

            }
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
        
    },
    capitalize(word){
        return word.charAt(0).toUpperCase() + word.slice(1)
    },
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
    @apply font-bold text-3xl
}
h2{
    @apply font-semibold
}
.par{
    @apply m-auto text-xs mb-4; 
}
</style>