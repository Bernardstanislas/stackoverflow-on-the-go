@extends('layouts.app')

@section('title', 'Stackoverflow on the go')

@section('query', $query)

@section('content')
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
        <div class="empty">
            <div class="text">
                <i>No result for "{{ $query }}".</i>
            </div>
        </div>
    @endif
    @if (!$query)
        <div class="empty">
            <div class="text">
                <i>Type what your are looking for in the search bar to start.</i>
            </div>
        </div>
    @endif
</div>
@endsection
