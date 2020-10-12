@extends("layouts/app")
@section('content')
	{{-- <h1>Edit infomation</h1> --}}
	<p> This is edit page</p>
	{!! Form::open(['action' => ['App\Http\Controllers\MessagesController@update', $message->id], 'method' => 'POST']) !!}
    {{ csrf_field() }}
    <div class="form-group">
        {{Form::label('content', 'content')}}
        {{Form::text('content',$message->content, ['class' => 'form-control', 'placeholder' =>"" ])}}
    </div>
    
    {{Form::submit('Update this message', ['class' =>'btn btn-primary'])}}
    {{Form::hidden('_method','PUT')}}
    {!! Form::close() !!}
@endsection