<template>
    <div class="bg-white min-h-screen text-black">
        <div class="p-8">
            <h1 class="text-3xl font-bold">Baranggay Clearance</h1><br>
            <div class="border-t-2 border-black">
                <p>Request Baranggay Clearance</p><br><br>
                <div class="request_container">
                    <h2>APPLICATION FORM</h2>
                    <h3>Application form will be generated based on your profile in web-app</h3>
                    <button>GENERATE</button><span>Succesfully generated</span><br>
                    <button>VIEW</button>
                </div>
                <div class="request_container">
                    <h2>CEDULA</h2>
                    <h3>Cedula will be generated based on your profile in web-app</h3>
                    <button>GENERATE</button><span>Succesfully generated</span><br>
                    <button>VIEW</button>
                </div>
                <div class="request_container">
                    <h2>PUROK CLEARANCE</h2>
                    <h3>Upload a photo/scanned copy of your recent purok clearance. Valid file types are <b>JPG</b> and <b>PDF</b> only</h3>
                    <input type="file" class="outline:none">
                </div>
            </div>
        </div>
        
    </div>
</template>

<script lang="ts">
import {reactive} from 'vue'
export default {
    setup(){
         definePageMeta({
            layout: 'user'
        });
    }

}
</script>

<style>

</style>