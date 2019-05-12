<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stackoverflow on the go</title>
</head>
<body>
<div>
    <form method="GET" action="{{ route('home') }}">
        <input name="query" value="{{ $query }}"/>
    </form>
</div>
@if ($posts)
    @foreach ($posts as $post)
        <p><a href="{{ route('show-post', ['id' => $post->id]) }}">{{ $post->title }}</a></p>
    @endforeach
@endif

@if ($query && count($posts) === 0)
    No result for "{{ $query }}".
@endif
</body>
</html>
