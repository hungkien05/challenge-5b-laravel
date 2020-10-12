@extends("layouts/app")
@section('content')
	{{-- <h1>Edit infomation</h1> --}}
	<p> This is edit page</p>
	{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
    	<div class="form-group">
    		{{Form::label('title', 'Title')}}
    		{{Form::text('title','', ['class' => 'form-control', 'placeholder' => 'title'])}}
    	</div>
    	<div class="form-group">
    		{{Form::label('body', 'Body')}}
    		{{Form::textarea('body','', ['class' => 'form-control', 'placeholder' => 'body'])}}
    	</div>
    	{{Form::submit('Submit', ['class' =>'btn btn-primary'])}}
	{!! Form::close() !!}
@endsection