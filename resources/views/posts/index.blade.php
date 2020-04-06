@extends('layout')

@section('content')
@forelse ($posts as $post)
	{{ $post->title }}
@empty
	<p>No blog posts</p>
@endforelse
@endsection('content')