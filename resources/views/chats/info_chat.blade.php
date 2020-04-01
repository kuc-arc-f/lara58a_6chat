@extends('layouts.app')
@section('title', '')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<!-- 
		Information:
		-->
	</div>
	<div class="panel-body">
		Name:
		<p>{{$chat->name}}<br />
		</p>
		info:
		<p>{{$chat->content }}
		</p>
		<hr />
		<h3>members:</h3>
		<table class="table table-striped task-table">
			<thead>
				<th>user</th>
				<th>join date</th>
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
						{{ $member->created_at }}
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
