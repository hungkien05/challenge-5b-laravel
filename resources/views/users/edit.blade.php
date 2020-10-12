@extends("layouts/app")
@section('content')
	{!! Form::open(['action' => ['App\Http\Controllers\UsersController@update', $user->id], 'method' => 'POST']) !!}
    {{ csrf_field() }}
    <div class="form-group">
        {{Form::label('username', 'Username')}}
        {{Form::text('username',$user->username, ['class' => 'form-control', 'placeholder' =>"" ])}}
    </div>
    <div class="form-group">
        {{Form::label('name', 'Full name')}}
        {{Form::text('name',$user->name, ['class' => 'form-control', 'placeholder' =>"" ])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::text('email',$user->email, ['class' => 'form-control', 'placeholder' =>"" ])}}
    </div>
    
    <div class="form-group">
        {{Form::label('phone', 'Phone')}}
        {{Form::text('phone',$user->phone, ['class' => 'form-control' ])}}
    </div>
    {{Form::submit('Update this user\'s profile', ['class' =>'btn btn-primary'])}}
    {{Form::hidden('_method','PUT')}}
    {!! Form::close() !!}
@endsection