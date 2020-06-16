@extends('layouts.app')
@section('title', 'info_chat')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading" style="padding-top: 10px;">
		{{ link_to_route('chats.index', '戻る',  null, ['class' => 'btn btn-outline-primary'] ) }}
		<br />		
		<h3>Chat Information :
		</h3>
	</div>
	<hr />
	<div class="panel-body">
		Name:
		<h3>{{$chat->name}}<br />
		</h3>
		info:
		<p>{{$chat->content }}
		</p>
		Create : <?= $chat->created_at->format('Y-m-d') ?>

		<hr />
		<h3>Members:</h3>
		<table class="table table-striped task-table">
			<thead>
				<th>User name</th>
				<th>Join date</th>
			</thead>
			<?php //debug_dump($tasks); ?>
			<tbody>
				@foreach ($members as $member )
				<tr>
					<!--
					<td class="table-text">
						{{ $member->id }}
					</td>
					-->
					<td class="table-text">
						{{ $member->user_name }}
					</td>
					<td class="table-text">
						{{ $member->created_at->format('Y-m-d') }}
					</td>											
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
</div>
<!-- -->
<script>
</script>

@endsection
