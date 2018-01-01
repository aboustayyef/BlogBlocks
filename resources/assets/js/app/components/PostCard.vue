<template>
  <div  v-bind:class="{ 'lb-card' : true, 'lb-card--no-image': !hasImage }">
      <figure class="image is-3by2" v-if="this.post.media.length > 0" style="border-bottom:1px solid silver">
        <img :src="'/img/media/' + this.post.media[0].pointer" alt="Placeholder image">
      </figure>
      <div class="lb-card__section">
       <h1>
         {{post.short_title}}
       </h1> 
        <h2>
          {{post.source.name}}
        </h2>
      </div>
  </div>
</template>

<script>
    export default {
    props: ['post'] ,
    computed: {
        hasImage: function()
        {
          return this.post.media.length > 0;
        }
      }
    }
</script>