<template>
    <div class="bg-slate-100 min-h-screen text-black">
        <div>
            <h1 class="text-3xl font-bold">Select type of document you would like to request</h1>
            <p>You can choose more than one document request at a time</p>
            <div class="rounded-2xl bg white py-8 px-16">
                <div v-for="doc in documents" :key="doc.id">
                    <input type="checkbox" :id="doc.id" :name="doc.name" :value="doc.id" class="w-fit">
                    <label :for="doc.name">{{doc.name}}</label><br>
                </div>
            </div>
        </div>
        <!-- <div class="p-8">
            <h1 class="text-3xl font-bold">Baranggay Clearance</h1><br>
            <div class="border-t-2 border-black">
                <p>Request Baranggay Clearance</p><br><br>
                <div class="request_container">
                    <h2>APPLICATION FORM</h2>
                    <h3>Application form will be generated based on your profile in web-app</h3>
                    <button>GENERATE</button><span class="status">Succesfully generated</span><br>
                    <button class="isButtonEnabled">VIEW</button>
                </div>
                <div class="request_container">
                    <h2>CEDULA</h2>
                    <h3>Cedula will be generated based on your profile in web-app</h3>
                    <button>GENERATE</button><span class="status">Succesfully generated</span><br>
                    <button :class="buttonStatus" disable>VIEW</button>
                </div>
                <div class="request_container">
                    <h2>PUROK CLEARANCE</h2>
                    <h3>Upload a photo/scanned copy of your recent purok clearance. Valid file types are <b>JPG</b> and <b>PDF</b> only</h3>
                    <input type="file">
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
export default {
    layout: 'user',
    data(){
        return{
            buttonStatus: "isButtonDisabled",
            documents:[
                {
                    id:1,
                    name: "Baranggay Clearance"
                },
                {
                    id:2,
                    name: "Certificate of Residency"
                },
                {
                    id:3,
                    name: "Business Clearance"
                },
                {
                    id:4,
                    name: "Certificate of Indigency"
                },
                {
                    id:5,
                    name: "Baranggay Health Certificate"
                }
            ]
        }
    }
}
</script>

<style>

</style>