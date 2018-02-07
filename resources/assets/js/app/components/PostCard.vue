<template>
  <div :class="{'card-aspect-ratio':true, 'small-card': size=='small'}">
      <div class="lb-card">
        <figure class="image" style="border-bottom:1px solid silver">
          <img v-if="hasImage" :src="'/img/media/' + this.post.media[0].pointer" alt="Placeholder image">
          <img v-else :src="'/img/placeholder_600x400.svg'" alt="Placeholder image">
        </figure>
        <div class="lb-card__section">
         <h1 class="lb-card__title">
           {{post.short_title}}
         </h1> 
          <h2 class="lb-card__source-name">
            {{post.source.name}}
          </h2>
        </div>
      </div>
  </div>
</template>

<script>
    export default {
    props: ['post','size'] ,
    computed: {
        hasImage: function()
        {
          return this.post.media.length > 0;
        }
      }
    }
</script>