<h3 class="title is-4">Recent Posts</h3>
<div class="columns is-multiline">
  @foreach($recent_posts as $post)
  <div class="column is-one-fifth">
    <div class="box">{{$post->title}}</div>
  </div>
  @endforeach