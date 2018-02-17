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
<script src="{{mix('/js/app.js')}}"></script>    
</body>
</html>