@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="post">
    <div class="title">{{ $post->title }}</div>
    <hr/>
    <div class="question">
        <div class="stats">
            <p><b>{{ $post->score }}</b></p>
        </div>
        <div class="body">
            {!! $post->body !!}
        </div>
    </div>
    <br/>
    <br/>
    @if (count($post->answers) === 0)
        <i>No answer to this post yet.</i>
    @else
        <div class="answers-count">{{ count($post->answers) }} Answer{{ count($post->answers) > 1 ? 's' : '' }}</div>
        @foreach ($post->answers as $answer)
            <hr/>
            <div class="answer">
                <div class="stats">
                    <p><b>{{ $answer->score }}</b></p>
                    @if ($answer->accepted)
                    <p><b>&#10003;</b></p>
                    @endif
                </div>
                <div class="body">
                    {!! $answer->body !!}
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
