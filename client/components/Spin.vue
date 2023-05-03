<template>
  <div class="spin-container">
    <div class="spin-wrapper">
        <font-awesome-icon :icon="['fas', 'spinner']" class="spin-icon" spin />
    </div>
    
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.spin-icon{
    font-size: 60px;
    @apply text-sky-900
}
.spin-container{
    position: fixed;
    display: inline-block;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    text-align: center;
    z-index: 2;
    background: rgba(200,200,200,0.2);
}
.spin-wrapper{
    vertical-align: middle;
    top:50%;
    left:50%;
    @apply m-auto w-fit absolute
}

</style>