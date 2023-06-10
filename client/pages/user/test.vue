<template>
  <div>Test authentication</div>
</template>

<script>
export default {
    mounted(){
        this.$axios.get('/auth/test')
    }
}
</script>

<style>

</style>