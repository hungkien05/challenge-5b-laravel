@extends('layouts/app')

@section('content')
	<h1>Posts</h1>
	@if (count($posts)>0)
		@foreach($posts as $post)
			<div class="card card-body bg-light">
				<h3><a href="./posts/{{$post->id}}">{{$post->title}}</h3>
			</div>
		@endforeach
	@endif
@endsection