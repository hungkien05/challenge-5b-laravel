@extends("layouts.app")
@section('content')
	<div class="container">
    @if (isset($challenge))
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                	Assignment #{{$challenge->id}}: {{$challenge->name}}
					<span>
						{{-- <a href="./{{$challenge->id}}/getFile">Download</a> --}}
					</span>
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Hint: {{$challenge->hint}}
                    	{!! Form::open(['action' => ['App\Http\Controllers\ChallengesController@check'], 'method' => 'POST']) !!}
                    	<span class = "form-group">
                    		{{ csrf_field() }}
	                    	{{Form::label('answer', 'Type your answer')}}
                            {{Form::text('answer','', ['class' => 'form-control', 'placeholder' =>"Your answer" ])}}
                            {{Form::hidden('chlID', $challenge->id)}}
	                    </span>
	                    {{Form::submit('Submit', ['class' =>'btn btn-primary'])}}
	                    {!! Form::close() !!}
	                </p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center card card-body bg-light ">
        @if (isset($isCorrect))
            @if ($isCorrect)<?php
                $file = fopen(storage_path("app/public/challenges/".$challenge->filename.".txt"), "r");
                echo "<p style='color:green'>"."Correct answer. Here is the content of the file:"."<br></p>";
                while(!feof($file)) {
                    echo fgets($file). "<br>";
                }

                fclose($file);
                ?>
            @else <p>False</p>
            @endif
        @endif
    </div>
	</div>
@endsection