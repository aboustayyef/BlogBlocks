<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title')</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
<!-- Navigation Section -->
@include('layouts.partials.navbar')
<!-- /Section -->

<!--  Content  -->
<div id="content" class="section">
  <div class="container">
    <div class="columns">
      <div id="posts" class="column is-10"> 
        <div id="app">@yield('content')</div>
      </div>

      <aside id="sidebar" class="column is-2">
        <div class="title is-5">Side info</div>
        <p>
          <div>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, at ipsa quidem sint minima laudantium reprehenderit repudiandae voluptas voluptate facilis quas! Consequatur unde natus sint pariatur explicabo quam doloribus quae.</div>
        </p>
      </aside>
      <!-- Sidebar -->
    </div>
  </div>
</div>
<script src="/js/app.js"></script>    
</body>
</html>