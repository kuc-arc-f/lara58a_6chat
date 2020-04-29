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
			<h1>並べ替えサンプル</h1>
			<hr />
		</div>
		<div class="panel-body">
			<draggable tag="ul" v-model="tasks">
				<li v-for="task in tasks" :key="task.id"
					class="li_body">@{{ task.id }} / @{{ task.title }}
				</li>
			</draggable>				
			<!--
			<br />
			new:<br />
			{{ link_to_route('vue_sort_items.create', '[ create ]' ) }}
			<br />
			-->
		</div>
	</div>
	<hr />
	{!! Form::model(null , [
		'route' => 'vue_sort_items.update_number', 'method' => 'post', 'class' => 'form-horizontal'
	]) !!}	
	<div class="sorted_list_wrap" style="display : none;">
		<h3>sorted - List</h3>
		<ul>
			<li v-for="drag_item in drag_items" :key="drag_item.id"
			class="">
				ID: @{{ drag_item.id }} / order_no: @{{ drag_item.id }} / title: @{{ drag_item.title }}
			</li>		
		</ul>
		<input type="text" name="json_items" v-model="json_items" /><br /><br />
	</div>
	{!! Form::button('<i class="fa fa-save"></i> 並び替え順を保存する', 
		['type' => 'submit', 'class' => 'btn btn-primary']) !!}	
	{!! Form::close() !!}
	<hr />
	<br />
	<br />
</div>
@include('element.page_info',
[
    'git_url' => 'https://github.com/kuc-arc-f/lara58b_vue3_form',
    'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_20_sort_item'
])

<!-- -->
<script>
new Vue({
	el: '#app',
	beforeMount: function(){
		this.getTasks()
	},	   
	data: {
		tasks : [],
		drag_items : [],
		json_items : "",
	},
	methods: {
		getTasks () {
			axios.get('/api/api_sort_items/get_items')
				.then(res =>  {
					this.tasks = res.data
//console.log(res.data )
			})            
		},
	},
	computed:{
		getTasks: {
			get: function(){
				return this.tasks;
			},
			set: function(value) {
				this.tasks = value;
			}
		}
	},		
	watch: {
			tasks: function(value){
				this.drag_items = value;
				var i = 1;
				var new_items = [];
				value.forEach(function(item){
					var data = item;
					data.order_no = i;
					i = i+1;
					//console.log(data.id);
					new_items.push(data)
				});
console.log(new_items)
				this.json_items= JSON.stringify(new_items);				
			}
	},
});
</script>
<!-- -->
<style>
.li_body{
	 height: 50px; 
	 background : #DDD;
	 margin : 10px;
	 padding : 10px;
}
</style>

@endsection
