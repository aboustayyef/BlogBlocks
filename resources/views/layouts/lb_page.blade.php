<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" type="text/css" href="{{mix('/css/app.css')}}">
</head>
<body>
<script>
  var App_Token = "{{ csrf_token() }}";
</script>
<!-- Navigation Section -->
@include('layouts.partials.navbar')
<!-- /Section -->

<!--  Content  -->
<div id="content" class="section">
  <div class="container">
    @yield('app')
  </div>



</div>
    
    @if(env('APP_DEBUG'))
    <!-- Debugging Info, -->
        <div class="section">
            <div class="field is-grouped is-grouped-multiline">
            @foreach($_SERVER as $key => $value)
                <div class="control">
                    <div class="tags has-addons">
                        <span class="tag is-dark">{{$key}}</span>
                        <span class="tag is-info" title="{{$value}}">{{str_limit($value, 20)}}</span>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endif
<script src="{{mix('/js/app.js')}}"></script>    
</body>
</html>