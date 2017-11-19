<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
</head>
<body>
@foreach($posts as $post)
<h1>{{$post->title}}</h1>
@if($post->hasCache())
<div style="background-color:{{$post->rgb()}}; padding:5px">
    <img src="{{$post->image()}}">
</div>
@else
    <img src="{{$post->image()}}">
@endif

@endforeach
</body>
</html>