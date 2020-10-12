@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('This is profile of '.$user->username) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <p>User ID: {{$user->id}}</p>
                    <p>Full name: {{$user->name}}</p>
                    <p>Email: {{$user->email}}</p>
                    <p>Phone: {{$user->phone}}</p>
                </div>
            </div>
            @if (Auth::user()->isTeacher==1)
                <a href="./{{$user->id}}/edit" class="btn btn-warning">Edit (only for teacher)</a>
            @else
                <button type="button" class="btn btn-warning disabled">Edit (only for teacher)</button>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Messages') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hoever">
                            <thead>
                                <th>From</th>
                                <th>Content</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                <tr>
                                    @if ($message->fromID==$user->id and $message->toID==Auth::id())
                                        <td>{{ $user->username }}</td>
                                    @elseif ($message->toID==$user->id and $message->fromID==Auth::id())
                                        <td>{{ Auth::user()->username }}</td>
                                    @endif

                                    <td>{{ $message->content }}</td>
                                    @if(Auth::id()==$message->fromID)
                                        <td>
                                            <a href="{{url('/')}}/messages/{{$message->id}}/edit " class ="btn btn-sm btn-success" role="button">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('messages/'.$message->id) }}" method="post">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </form>
                                        </td>
                                    @else <td></td> <td></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                </div>
            </div>
            {!! Form::open(['action' => 'App\Http\Controllers\MessagesController@store', 'method' => 'POST']) !!}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{-- {{Form::label('content', 'content')}} --}}
                            {{Form::text('content','', ['class' => 'form-control', 'placeholder' =>"Type new message" ])}}
                            {{Form::hidden('toID', $user->id)}}
                            {{Form::submit('Send', ['class' =>'btn btn-primary'])}}
                        </div>
                        
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection