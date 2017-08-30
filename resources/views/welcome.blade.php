@extends('template.main')
@section('title'){{'TEST JSON'}}@endsection

@section('content')
	<div class="row-fluid">
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Test</h1>

				<p>Author : Joaquin Pino Giraldez</p>

				<a href="{{ url('data') }}" class="btn btn-primary btn-lg active" role="button">Start</a>

			</div>
		</div>
	</div>
@stop