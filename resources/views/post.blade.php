<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $post->title }}</title>
</head>
<body>
<div>
    <h1>{{ $post->title }}</h1>
    <div>
        {!! $post->body !!}
    </div>
    <hr/>
    @if (count($post->answers) === 0)
        <i>No answer to this post yet.</i>
    @endif
    @foreach ($post->answers as $answer)
        <div>{!! $answer->body !!}</div>
    @endforeach
</div>
</body>
</html>
