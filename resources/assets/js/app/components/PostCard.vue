<template>
    <div class="card">
      <div class="card-image" v-if="this.post.media.length > 0">
        <figure class="image is-3by2" style="border-bottom:1px solid silver">
          <img :src="'/img/media/' + this.post.media[0].pointer" alt="Placeholder image">
        </figure>
      </div>
      <div class="card-content">
        <div class="media">
          <div class="media-left">
            <figure class="image is-48x48">
              <img src="https://bulma.io/images/placeholders/48x48.png" alt="Placeholder image">
            </figure>
          </div>
          <div class="media-content">
            <p class="title is-5">{{post.source.name}}</p>
          </div>
        </div>

        <div class="content">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Phasellus nec iaculis mauris. <a>@bulmaio</a>.
          <a href="#">#css</a> <a href="#">#responsive</a>
          <br>
          <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
        </div>
      </div>
    </div>
</template>

<script>
    export default {
        props: ['post'],
    }
</script>
