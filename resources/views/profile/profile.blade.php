@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You can only change your email and phone number here.') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {!! Form::open(['action' => 'App\Http\Controllers\ProfileController@updateAuth', 'method' => 'POST']) !!}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('email', 'Email')}}
                            {{Form::text('email',Auth::user()->email, ['class' => 'form-control', 'placeholder' =>"" ])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('phone', 'Phone')}}
                            {{Form::text('phone',Auth::user()->phone, ['class' => 'form-control' ])}}
                        </div>
                        {{Form::submit('Update profile', ['class' =>'btn btn-primary'])}}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
