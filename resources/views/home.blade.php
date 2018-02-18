@extends('layouts.lb_page')
@section('title')
    Home Page
@stop
@section('app')
    <div id="app">
        <app debug="{{env('APP_DEBUG') ? 'true' : 'false'}}"></app>
    </div>
@stop