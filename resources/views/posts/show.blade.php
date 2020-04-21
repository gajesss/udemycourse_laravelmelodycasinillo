@extends('layout')

@section('content')
<h1>{{ $post->title }}
@if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 30)
@component('components.badge', ['type' => 'primary'],['show'=>true])
Brand new Post!
@endcomponent
@endif
</h1>

<p>{{ $post->content }}</p>


@component('components.updated',['date' => $post->created_at, 'name' => $post->user->name])
@endcomponent
@component('components.updated',['date' => $post->updated_at])
    Updated
@endcomponent
<p>Currently read by {{ $counter }} people</p>

<h4>Comments</h4>

@forelse($post->comments as $comment)
    <p>
        {{ $comment->content }}
    
        @component('components.updated',['date' => $comment->created_at])
    @endcomponent
@empty
    <p>No comments yet!</p>
@endforelse
@endsection('content')