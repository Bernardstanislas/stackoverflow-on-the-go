<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Stackoverflow on the go</title>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Stackoverflow, on the go!</h1>
        <form class="search" method="GET" action="{{ route('home') }}">
            <input name="query" value="{{ $query }}"/>
        </form>
    </div>
    <div class="search-results">
        @if ($posts)
            <i>{{ $posts->result()->totalHits() }} posts found in {{ $posts->result()->took() }}ms</i>
            <div class="posts">
                @foreach ($posts as $post)
                    <div class="post">
                        <div class="title"><a href="{{ route('show-post', ['id' => $post->id]) }}">{{ $post->title }}</a></div>
                        <div class="body">{!! $post->body !!}</div>
                    </div>
                @endforeach
            </div>
            {{ $posts->appends(['query' => $query])->links() }}
        @endif

        @if ($query && count($posts) === 0)
            No result for "{{ $query }}".
        @endif
    </div>
</div>
</body>
</html>
