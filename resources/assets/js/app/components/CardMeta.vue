<template>
  <div class="level">
    <div class="level-left">{{hours}} {{hour_or_hours}} ago</div>
    <div class="level-right" style="width:40%">
        <!-- Nothing for now -->
        <!-- <small>Score: {{score}}</small> --> 
        <!-- <progress class="progress is-small" value="15" max="100">15%</progress> -->
    </div>
  </div>
</template>

<script>
    export default {
      props: ['hours', 'score'],
      computed: {
        hour_or_hours: function(){
          let vm = this;
          if (vm.hours == 1) {
            return 'hour';
          }
          return 'hours';
        }
      }
    }
</script>

<style scoped>
  .level-left{
    font-size:0.65em;
    color:#b12530;
  }  
</style>