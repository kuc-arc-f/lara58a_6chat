@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 200px;">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					You are logged in!
				</div>
			</div>
		</div>
	</div>
	<!-- btn -->
	<div class="button_area_wrap mt-4" style="text-align: center;">
		<div class="form-group">
			<a href="/chats" class="btn btn-outline-primary" >Chats</a>
		</div>
		<div class="form-group">
			<a href="/plans" class="btn btn-outline-primary" >Plans</a>
		</div>
		<div class="form-group">
			<a href="/todos" class="btn btn-outline-primary" >Todos</a>
		</div>
	</div>
</div>
@endsection
