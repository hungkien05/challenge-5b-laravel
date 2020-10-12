@extends("layouts.app")
@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                	Assignment #{{$upload->id}}: {{$upload->name}}
					<span>
						<a href="./{{$upload->id}}/getFile">Download</a>
					</span>
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Upload your homework here:
                    	{!! Form::open(['action' => 'App\Http\Controllers\HomeworksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    	<span class = "form-group">
                    		{{ csrf_field() }}
	                    	{{Form::file('student_hw')}}
	                    	{{Form::hidden('hwID', $upload->id)}}
	                    </span>
	                    {{Form::submit('Upload', ['class' =>'btn btn-primary'])}}
	                    {!! Form::close() !!}
	                </p>
                </div>
            </div>
        </div>
        {{-- display this user's submiited homework --}}
        @if (Auth::user()->isTeacher==0)
            <div class="col-lg-6 col-lg-offset-3">
                <div class="card">
                    <div class="card-header">
                        My submission for this homework
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-striped table-hoever">
                            <thead>
                                <th>Submisson ID</th>
                                <th>Filename</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($myHomeworks as $myHomework)
                                <tr>
                                    <td>{{ $myHomework->id }}</td>
                                    <td>{{ $myHomework->filename }}</td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
        </br>
    {{-- display all homeworks of all student --}}
    @if (Auth::user()->isTeacher==1)
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(count($homeworks)>0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Submitted homework for this assignment:
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hoever">
                                <thead>
                                    <th>Submisson ID</th>
                                    <th>Filename</th>
                                    <th>From User</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($homeworks as $homework)
                                    <tr>
                                        <td>{{ $homework->id }}</td>
                                        <td>{{ $homework->filename }}</td>
                                        <td>{{$homework->fromUser}}</td>
                                        <td>
                                            
                                            <a href="{{url('/')}}/homeworks/{{$homework->id}}/getFile" class ="btn btn-sm btn-success" role="button">Download</a>
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
    @endif
	</div>
@endsection