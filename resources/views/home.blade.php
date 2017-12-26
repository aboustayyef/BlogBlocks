<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
</head>
<body>
@foreach($scores as $score)
    <div style="width:600px;margin:2em auto">
<h1>{{$score->post->title}}</h1>
<h3>{{$score->post->posted_at->diffInHours()}} Hours Ago - Likes:{{$score->likes}} - Score:{{$score->score}}</h3>
@if($score->post->hasCache())
<div style="background-color:{{$score->post->rgb()}}; padding:5px">
    <img src="{{$score->post->image()}}">
</div>
@else
    <img src="{{$score->post->image()}}">
@endif
    </div>
@endforeach
</body>
</html>