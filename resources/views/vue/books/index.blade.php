@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')
<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading">
			<BR />
			<h1>Vue Books 一覧 </h1>
			{{ link_to_route('vue_books.create', 'Create' ,null, ['class' => 'btn btn-primary'] ) }}
			<BR />
			<BR />
		</div>
		<div class="panel-body">
			<table class="table table-striped task-table">
				<thead>
					<th>ID</th>
					<th>title</th>
					<th>Action</th>
				</thead>
				<tbody>
				<tr v-for="task in tasks" v-bind:key="task.id">
					<td>@{{ task.id }}
					</td>
					<td>
						<h4>@{{ task.title }}
						</h4>
					</td>
					<td>
						<a v-bind:href="'/vue_books/' + task.id + '/edit'">[ edit ]
						</a>
					</td>					
				</tr>
				</tbody>
			</table>
			<hr />
			<br />
			<br />
		</div>
	</div>
</div>
@include('element.page_info',
[
    'git_url' => 'https://github.com/kuc-arc-f/lara58b_vue3_form',
    'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_19_form'
])
<!-- -->
<script>
new Vue({
	el: '#app',
	created () {
		this.getTasks(0);
	},    
	data: {
		tasks : [],
	},
	methods: {
		getTasks (complete) {
			axios.get('/api/apibooks/get_tasks')
				.then(res =>  {
					this.tasks = res.data
console.log(res.data )
			})            
		},
	}
});
</script>

@endsection
