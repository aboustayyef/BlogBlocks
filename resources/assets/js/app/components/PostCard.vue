<template>
  <div :class="{'card-aspect-ratio':true, 'small-card': size=='small', 'debug': settings.debug}">
      <div class="lb-card" @click="exit()">
        
        <!-- Post Image -->
        <figure class="image is-3by2" :style="{backgroundColor: dominantColor}">
          <img v-if="hasImage" :src="'/img/media/' + this.post.media[0].pointer" alt="Placeholder image">
          <img v-else :src="'/img/placeholder_600x400.svg'" alt="Placeholder image">
        </figure>

        <div class="lb-card__section">

          <!-- Post Title -->
          <h1 class="lb-card__title">
           {{post.short_title}}
          </h1> 
          
          <!-- Debug info -->
          <div v-if="settings.debug" style="margin-top:1em">
            <div class="tags">
              <span class="tag is-small is-warning">fb:{{post.score.likes}}</span>
              <span class="tag is-small is-warning">hours: {{post.score.hours_ago}}</span>
              <span class="tag is-small is-warning">latest:{{post.latest_score}}</span>
              <span class="tag is-small is-warning">best:{{post.best_score}}</span>
            </div>
          </div>

          <!-- Post Source Name -->
          <h2 class="lb-card__source-name">
            {{post.source.name}}
          </h2>

        </div>
      </div>
  </div>
</template>

<script>
    export default {
    props: ['settings', 'post','size'] ,
    methods:{
      exit: function()
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