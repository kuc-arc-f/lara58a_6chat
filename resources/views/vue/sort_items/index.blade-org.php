@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')
<!-- CDNJS :: Sortable (https://cdnjs.com/) -->
<script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
<!-- CDNJS :: Vue.Draggable (https://cdnjs.com/) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>
<!-- -->
<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading">
			タスク一覧
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<th>Id</th>
					<th>タスク名</th>
					<th>編集</th>
					<th>削除</th>
				</thead>
				<tbody v-for="task in tasks" v-bind:key="task.id">
					<tr>
						<td>@{{ task.id }}
						</td>
						<td>
						<h4>
							<a v-bind:href="'/tasks/' + task.id">@{{ task.title }}
							</a>
						</h4>
						</td>                        
						<td>
							<a v-bind:href="'/tasks/' + task.id + '/edit'">[ edit ]
							</a>
						</td>
					</tr>                    
				</tbody>
			</table>
			<br />
			new:<br />
			{{ link_to_route('vue_sort_items.create', '[ create ]' ) }}
			<br />
			<br />
		</div>
	</div>
</div>
<!-- -->
<script>
new Vue({
	el: '#app',
	created () {
		this.getTasks();
	},    
	data: {
		tasks : [],
	},
	methods: {
		getTasks () {
			axios.get('/api/api_sort_items/get_items')
				.then(res =>  {
					this.tasks = res.data
//console.log(res.data )
			})            
		},
	}
});
</script>
@endsection
