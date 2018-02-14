<template>
  <div :class="{'card-aspect-ratio':true, 'small-card': size=='small'}">
      <div class="lb-card" @click="register_exit()">
        <figure class="image is-3by2" :style="{backgroundColor: dominantColor}">
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
    methods:{
      register_exit: function()
      {
        axios.get('/api/registerExit/'+this.post.id+'?session_id='+App_Token, (d) => {}) 
          .then((d)=> {
            console.log('redirect now to ' + this.post.url);
         })
      }
    },
    computed: {
        hasImage: function()
        {
          return this.post.media.length > 0;
        },
        dominantColor: function()
        {
          let cols = eval(this.post.media[0].dominant_color);
          return 'rgb(' + cols[0] + ',' + cols[1] + ',' + cols[2] + ')';
        }
      }
    }
</script>