<template>
  <div class="modal">
    <div class="content">
        <h1 class="text-3xl font-bold">REQUEST NO.{{renderID(details.id)}}</h1>
        <div class="grid grid-cols-3">
            <div class="col-span-2">
                <div class="border-y border-slate-500">
                    asdasd
                </div>

            </div>
            <div>

            </div>

        </div>
    </div>
  </div>
</template>

<script>
export default {
    props:['details'],
    data(){
        return{
            data:[]
        }
    },
    mounted(){

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
    }
}
</script>

<style>

</style>