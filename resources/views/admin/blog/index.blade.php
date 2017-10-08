@extends('layouts.app')

@section('content')
<div class="container">
   <div>
        <h1>Blogs At LB</h1>
        <a href="{{route('blog.create')}}" class="btn btn-primary pull-right">Create New Blog</a>
   </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Nickname</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            @foreach($blogs as $blog)
                <tr>

                    <td>{{$blog->name}}</td>
                    <td>{{$blog->nickname}}</td>
                    <td>{{$blog->description}}</td>
                    <td><a href="{{route('blog.edit', ['id' => $blog->id])}}">edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">{{ $blogs->links() }}</div>
</div>
@stop