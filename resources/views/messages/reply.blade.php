
@extends('layouts.app')

@section('title', 'reply')

@section('content')
<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading" style="margin-top: 10px;">
			{{ link_to_route('messages.index', '戻る', null, 
			['class' => 'btn btn-outline-primary'] ) }}
			<br />
			<h3 class="" style="margin-top: 8px;">Message - 返信</h3>
		</div>
		<hr class="mt-0 mb-0" />
		@if (count($errors) > 0)
			<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
			</div>
		@endif
		<div class="panel-body">
			<!--
			{!! Form::model($message, [
				'route' => 'messages.store', 'method' => 'post', 'class' => 'form-horizontal',
				'id'=>'form_message'
				]) 
			!!}
			-->
			<form action="/messages" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}			
			<div class="form-group">
				<div class="col-sm-6">
					<!-- to_id: -->
					{!! Form::hidden('to_id', $message->from_id, [
						 'class' => "form-control",
						 'id' => 'to_id'  ]) 
					!!}
				</div>
			</div>
			<div class="form-group">
				<div class="sent_user_wrap" style="display:1 ;">
					<div class="col-sm-8">
						<?php //var_dump($from_user); ?>
						送信先 : <?= $from_user->name ?> / <?= $from_user->email ?>
					</div>
				</div>
				<hr />
			</div>

			<div class="form-group">
				<?php $class_title = "form-control";
				?>
				{!! Form::label('title', 'タイトル:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-8">
					{!! Form::text('title', "Re : " . $message->title, [
						'id' => 'message-title', 'class' => $class_title ,'required'=>'required' ]) 
					!!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('content', '本文:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-8">
					{!! Form::textarea('content', $message->content, [
						'id' => 'message-content', 'class' => 'form-control',
						'rows' => 10,'cols' => 10,
						'required'=>'required'
					]) !!}
				</div>
			</div>
			<hr />
			<div class="form-group">
				Attach file :
				<div class="col-sm-8">
					<input type="file" value="Select File" name="attach_file"
					class="btn btn-outline-primary" />
				</div>				
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6 sumit_btn">
					{!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
		<hr />
		<br />
		<div class="panel-footer">
		</div>
	</div>
</div>

<!-- -->
<script>
</script>
<!-- -->
<style>
</style>
@endsection
