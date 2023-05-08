<template>
  <div class="modal">
    <div class="content">
        <h1>REQUEST NO.{{renderID(data.id)}}</h1>
    </div>
  </div>
</template>

<script>
export default {
    props:['id'],
    data(){
        return{
            data:[]
        }
    },
    mounted(){
        this.getDetails()
    },
    methods:{
        renderID(id){
            console.log(id)
            const charID = id.toString()
            if(charID.length<6){
                const zerosToAdd = 6 - charID.length
                let stringID = ""
                for(let i = 0; i < zerosToAdd; i++){
                    stringID += "0"
                    
                }
                stringID = stringID + charID
                return stringID 
            }
            return id
        },
        async getDetails(){
            await this.$axios.get('/admin/get-request/'+this.id).then(response=>{
                this.data = response.data
            })
        }
    }
}
</script>

<style>

</style>