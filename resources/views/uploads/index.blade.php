@extends('layouts/app')

@section('content')
	<div class="container">
		@if (Auth::user()->isTeacher==1)
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">{{ __('Upload assignments') }}</div>

		                <div class="card-body">
		                    @if (session('status'))
		                        <div class="alert alert-success" role="alert">
		                            {{ session('status') }}
		                        </div>
		                    @endif
		                    {!! Form::open(['action' => 'App\Http\Controllers\UploadsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		                    <div class="form-group">
		                    	{{ csrf_field() }}
		                    	{{Form::label('name', 'Assignment\'s name')}}
	        					{{Form::text('name','', ['class' => 'form-control', 'placeholder' =>"" ])}}
		                    	{{Form::file('teacher_hw')}}
		                    </div>
		                    {{Form::submit('Upload', ['class' =>'btn btn-primary'])}}

		                    {!! Form::close() !!}
		                </div>
		            </div>
		        </div>
		    </div>
		@endif
	
		@if (count($uploads)>0)
			@foreach($uploads as $upload)
				<div class="card card-body bg-light">
					{{-- <h3><a href="./uploads/{{$upload->id}}">{{$upload->filename}}</h3> --}}
					<h3><a href="{{url('/')}}/uploads/{{$upload->id}}">{{$upload->id}}, {{$upload->name}}</h3>
					<p>Created at {{$upload->created_at}}</p>
				</div>
			@endforeach
		@endif
	</div>
@endsection