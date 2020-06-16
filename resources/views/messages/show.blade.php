@extends('layouts.app')

@section('title', "show" )

@section('content')
<div class="panel panel-default" style="padding-top: 10px;">
	<div class="row">
		<div class="col-sm-6">
			{{ link_to_route('messages.index', '戻る', null, 
			['class' => 'btn btn-outline-primary'] ) }}
		</div>
		<div class="col-sm-6">
		</div>
	</div>
	<hr class="mt-2 mb-2">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-6">
				<h3 >{{ $message->title }} </h3>
			</div>
			<div class="col-sm-6">
				<?php if(isset($edit_mode) == false){ ?>
					<a href="/messages/reply?id=<?= $message->id ?>" class="btn btn-primary btn-sm"
						data-toggle="tooltip" title="reply message">
						<i class="fas fa-reply"></i> Reply
					</a>
				<?php } ?>
				<a href="/messages/export?id=<?= $message->id ?>" class="btn btn-outline-primary btn-sm"
					data-toggle="tooltip" title="export text file">
					<i class="fas fa-download"></i> &nbsp;export
				</a>
			</div>
		</div>
		<p>
			<?php //var_dump($to_user);
			?>
			Date : {{ $message->created_at }} <br />
			<?php if(empty($from_user) == false){ ?>
				from : <?= $from_user->name ?> / <?= $from_user->email ?><br />
			<?php } ?>
			To : <?= $to_user->name ?> / <?= $to_user->email ?> <br />
			ID : {{ $message->id }} <br />
		</p>
		<hr />
	</div>
	<div class="panel-body">
		<div class="form-group">
			{!! Form::label('content', '本文:', ['class' => 'col-sm-3 control-label']) !!}
			<div class="col-sm-8">
				<pre class="pre_text"><?= $message->content ?></pre>
			</div>
		</div>
	</div>
	<hr />
	<div class="panel-footer">
		<?php if(empty($message_file) == false){ ?>
			Attach file :
			<a href="/files/message_files/<?= $message_file->name ?>"
				data-toggle="tooltip" title="Attach file download"
				class="btn btn-outline-primary">
				<i class="fas fa-paperclip"></i> File 
			</a>
			<hr />
		<?php }?>
		<?php if(isset($edit_mode)){ ?>
            <!-- delete -->
            <div class="form-group">
                {{ Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) }}
                {{ Form::hidden('id', $message->id) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) }}
                {{ Form::close() }}
			</div>
		<?php }else{ ?>	
			<a href="/messages/reply?id=<?= $message->id ?>" class="btn btn-primary">
				<i class="fas fa-reply"></i> Reply
			</a>
		<?php } ?>

	</div>
</div>
<!-- -->
<style>
.panel-body .pre_text{
	border: 1px solid #000;
	background: #EEE;
	padding : 10px;
	font-family: BlinkMacSystemFont,"Segoe UI",Roboto;
	font-size: 1.0rem;
}    
</style>
@endsection
