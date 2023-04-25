<template>
    <div class="md:p-20">
        <h1 class="text-3xl font-bold">Complete the Request Form</h1>
        <p class="font-medium">Make sure to not leave any field blank</p><br>
        <form>
            <div class="col-span-2">
                <p class="label">Full Name<span class="guide"> (First Name M.I. Last Name)</span></p>
                <div class="box">
                    {{data.first_name + " " + data.middle_initial + ". " + data.last_name}}
                </div>
            </div>
            <div>
                <p class="label">Age</p>
                <div class="box">
                    {{data.first_name + " " + data.middle_initial + ". " + data.last_name}}
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            data:''
        }
    },
    mounted(){
        this.getUser()
    },
    methods:{
        async getUser(){
            await this.$axios.get('/user/get-details').then(response=>{
                this.data = response.data
                this.data.middle_initial = response.data.middle_name[0]
            })
        }
    }

}
</script>

<style scoped>
.label{
    @apply font-semibold text-xl
}
.guide{
    @apply text-slate-400 font-normal
}
.box{
    @apply py-2 px-4 border border-black rounded-lg mt-4 text-xl
}
form{
    @apply grid grid-cols-2 gap-4 bg-white p-8 md:rounded-xl
}

</style>