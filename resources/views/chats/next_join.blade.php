
@extends('layouts.app')

@section('title', '')

@section('content')
    <div class="panel panel-default">
        <br />
        <div class="panel-heading">
            {{ link_to_route('chats.index', '戻る'  ,null, ['class' => 'btn btn-outline-primary'] ) }}
            <br />
            <br />
            <h3>chat 参加確認</h3>
        </div>
        <hr />
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
			<h3>chat: <?= $chat->name ?></h3>
			<a href="/chats/add_member?cid=<?= $chat_id ?>" class="btn btn-outline-primary">
				このチャットへ参加する
			</a>
			<br /><br />
		</div>
		<!--  class="mt-10" -->
        <hr />
        <br />
        <div class="panel-footer">
        </div>
    </div>
@endsection
