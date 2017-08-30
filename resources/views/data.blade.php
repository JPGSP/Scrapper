@extends('template.main')
@section('title'){{'TEST JSON'}}@endsection

@section('content')
	<div class="row-fluid">
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Result Page</h1>

				<!-- <button type="button" class="btn btn-primary">
					<a href="{{ url('/') }}" class="btn btn-xs btn-info pull-right">Start</a>
					Start
				</button> -->
				
				<?php
				echo "<pre>";
				print_r($result);
				echo "</pre>";
				?>

				<a href="{{ url('/') }}" class="btn btn-primary btn-lg active" role="button">Back</a>
				<!--<button type="button" class="btn btn-success">Success</button>-->
			</div>
		</div>
	</div>
@stop