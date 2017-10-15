@extends('layouts.administration');
@section('content')
    <div class="container">
        <h1>Create new Blog</h1>
        <form method="POST" action="/admin/blog/" >
            @include('admin.blog._form')
        <input type="submit" class="btn btn-primary"></input>
        </form>
    </div>
@stop