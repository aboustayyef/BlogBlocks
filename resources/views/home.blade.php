<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
</head>
<body>
@foreach($posts as $post)
<h1>{{$post->title}}</h1>
<img src="{{$post->image()}}">

@endforeach
</body>
</html>