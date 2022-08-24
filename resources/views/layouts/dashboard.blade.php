<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
@yield('meta')

<!-- <link rel="apple-touch-icon" sizes="180x180" href="{{asset('static/favicon/apple-touch-icon.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('static/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('static/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('static/favicon/site.webmanifest')}}">
  <link rel="mask-icon" href="{{asset('static/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff"> -->

    <!-- Main CSS file -->
    <link rel="stylesheet" href="{{mix('static/mix/css/main.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>{{env('APP_NAME')}} | @yield('title')</title>
</head>

<body class="page">
<div class="dashboard">
@include('partials.sidebar')
@yield('content')
</div>
<script type="text/javascript" src="{{mix('static/mix/js/index.js')}}"></script>
</body>

</html>
