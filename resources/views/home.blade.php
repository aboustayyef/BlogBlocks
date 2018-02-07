@extends('layouts.lb_page')
@section('title')
    Home Page
@stop
@section('content')
    <post-group 
        size="large" 
        title="Hot Posts"
        apisource="/api/hot/4"
    ></post-group>
    
    <post-group 
        size="small" 
        title="Latest Posts"
        apisource="/api/posts/18"
    ></post-group>

@stop