<template>
  
</template>

<script>
export default {
    setup(){
    var pusher = new Pusher('52fd5f8416faab127a1a', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      app.messages.push(JSON.stringify(data));
    });
    }
}
</script>

<style>

</style>