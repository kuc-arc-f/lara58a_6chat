@extends('layouts.app')

@section('title', '')

@section('content')
<div class="panel panel-default">
	<br />
	{{ link_to_route('messages.index', '戻る', null, ['class' => 'btn btn-outline-primary'] ) }}
	<hr class="mt-2 mb-2">
	<div class="panel-heading">
		<h3 >{{ $message->title }} </h3>
		<p>
			<?php //var_dump($to_user);
			?>
			Date : {{ $message->created_at }} <br />
			from : <?= $from_user->name ?><br />
			To : <?= $to_user->name ?><br />
		</p>
		<hr />
	</div>
	<div class="panel-body">
		<div class="form-group">
			{!! Form::label('content', '本文:', ['class' => 'col-sm-3 control-label']) !!}
			<div class="col-sm-6">
				<pre class="pre_text"><?= $message->content ?></pre>
			</div>
		</div>
	</div>
	<hr />
	<div class="panel-footer">
		<?php if(isset($edit_mode)){ ?>
            <!-- delete -->
            <div class="form-group">
                {{ Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) }}
                {{ Form::hidden('id', $message->id) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) }}
                {{ Form::close() }}
			</div>
		<?php }else{ ?>			
			<a href="/messages/reply?id=<?= $message->id ?>"
				 class="btn btn-outline-primary">Reply
		<?php } ?>

		</a>
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
