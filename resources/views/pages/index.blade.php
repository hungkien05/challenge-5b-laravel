@extends("layouts/app")
@section('content')
	
	<div class="jumbotron text-center">
		@guest
			<p>Welcome to the Student Management System !</p>
			<p><a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">Login</a><a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Register</a></p>
		@else
			<h4 style='color:green'>Welcome back, {{Auth::user()->username}} ! </h4>
		@endguest
	</div>
@endsection