<template>
    <div class="flex flex-col min-h-screen">
        <AppHeader />
        <div class="home">
            <div class="description-title text-right">
                <img src="~assets/images/Maranding_Logo.png" width="200" height="200" class="m-auto"/>
                <h1>Make your document request faster</h1><br>
                <p class="font-medium">Save your time and have a hassle free request of branggay documents.</p>
            </div>
            <AdminLogin />
        </div>
 
        <AppFooter />
    </div>
    
</template>

<script>
export default {
    middleware:['login']
}
</script>

<style scoped>
h1{
    line-height: 3.5rem;
}

</style>