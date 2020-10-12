@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <p>Hi, {{Auth::user()->username}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($users)>0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current users
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hoever">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{-- <form action="{{ url('user/'.$user->id) }}" method="post">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form> --}}
                                        <a href="./users/{{$user->id}}" class ="btn btn-sm btn-success" role="button">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
