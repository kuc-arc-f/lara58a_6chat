@extends('layouts.app')

@section('title', "")

@section('content')
<div class="panel panel-default">
	<br />
	<div class="panel-heading">
		<h1>User show  :</h1>
	</div>
	<hr />
	<br />
	<div class="panel-body">
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">name :</label>
			<div class="col-sm-6">
				{{ $user->name }}
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">mail : </label>
			<div class="col-sm-6">
				{{ $user->email }}
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">created : </label>
			<div class="col-sm-6">
				{{ $user->created_at }}
			</div>
		</div>

	</div>
	<hr />
	<br />
	<div class="panel-footer">
	</div>
</div>
@endsection
