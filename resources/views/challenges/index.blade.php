@extends('layouts/app')

@section('content')
	<div class="container">
		@if (Auth::user()->isTeacher==1)
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">{{ __('Challenge assignments') }}</div>

		                <div class="card-body">
		                    @if (session('status'))
		                        <div class="alert alert-success" role="alert">
		                            {{ session('status') }}
		                        </div>
		                    @endif
		                    {!! Form::open(['action' => 'App\Http\Controllers\ChallengesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		                    <div class="form-group">
		                    	{{ csrf_field() }}
		                    	{{Form::label('name', 'Challenge\'s name:')}}
	        					{{Form::text('name','', ['class' => 'form-control', 'placeholder' =>"" ])}}
	        					{{Form::label('hint', 'Hint: ')}}
	        					{{Form::text('hint','', ['class' => 'form-control', 'placeholder' =>"" ])}}
		                    	{{Form::file('challenge-file')}}
		                    </div>
		                    {{Form::submit('Submit', ['class' =>'btn btn-primary'])}}

		                    {!! Form::close() !!}
		                </div>
		            </div>
		        </div>
		    </div>
		@endif
	
		@if (count($challenges)>0)
			@foreach($challenges as $challenge)
				<div class="card card-body bg-light">
					{{-- <h3><a href="./challenges/{{$challenge->id}}">{{$challenge->filename}}</h3> --}}
					<h3><a href="{{url('/')}}/challenges/{{$challenge->id}}">{{$challenge->id}}, {{$challenge->name}}</h3>
					<p>Created at {{$challenge->created_at}}</p>
				</div>
			@endforeach
		@endif
	</div>
@endsection