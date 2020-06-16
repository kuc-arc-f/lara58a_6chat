@extends('layouts.app')

@section('title', "edit")

@section('content')

	<div class="panel panel-default">
		<br />
		<div class="panel-heading">
		<h3>Mypage / User edit</h3>
		</div>
		<hr />
		<div class="panel-body">
			{!! Form::model($user, ['route' => ['mypage.update', $user->id], 'method' => 'patch', 
			'class' => 'form-horizontal']) !!}
				<div class="form-group">
					{!! Form::label('name', 'name :', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						{!! Form::text('name', $user->name, [
							'id' => 'user-title', 'class' => 'form-control'
						]) !!}
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						{!! Form::button('<i class="fa fa-save"></i> 保存', 
						['type' => 'submit', 'class' => 'btn btn-primary']) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
		<hr />
		<br />
		<div class="panel-footer">
			{{ Form::open(['route' => ['mypage.destroy', $user->id], 
				'id'=> 'form_delete' ,'method' => 'delete']) }}
			{{ Form::hidden('id', $user->id) }}
			{{ Form::close() }}

			<a href="#" onClick="delete_user();"
				 class="btn btn-danger">Delete
			</a><br />
		</div>
	</div>
<!-- -->
<script>
function delete_user(){
	//ユーザーを削除します。よろしいですか？
	if (window.confirm("Delete user,  OK?")) {
		$("#form_delete").submit();
	}
}
</script>    
@endsection
