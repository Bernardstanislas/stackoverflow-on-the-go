<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Stackoverflow, on the go!</h1>
        <form class="search" method="GET" action="{{ route('home') }}">
            <input name="query" value="@yield('query')"/>
        </form>
    </div>
    @yield('content')
</div>
</body>
</html>
