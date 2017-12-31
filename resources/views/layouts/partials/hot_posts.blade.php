<h3 class="title is-4">Hot Posts</h3>
<div class="columns">
  @foreach($hot_posts as $post)
    <div class="column is-one-quarter">
      <div class="box">{{$post->post->title}}</div>
    </div>
  @endforeach
</div>