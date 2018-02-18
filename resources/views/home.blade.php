@extends('layouts.lb_page')
@section('title')
    Home Page
@stop
@section('app')
    <div id="app">
        <app 
            debug="{{env('APP_DEBUG') ? 'true' : 'false'}}"
            @if(isset($tag))
            tag="{{$tag}}"
            @endif
        ></app>
    </div>
@stop