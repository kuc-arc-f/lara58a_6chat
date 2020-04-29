@extends('layouts.app')

@section('title', "編集")

@section('content')
<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading">
		<br />
		<h1>編集</h1>
		</div>
		<hr />
		<div class="panel-body">
			{!! Form::model($todo, ['route' => ['todos.update', 0 ], 'method' => 'patch', 
			'class' => 'form-horizontal']) !!}
			{!! Form::close() !!}
				<div class="form-group">
					{!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<input type="text" class="form-control" id="title" v-model="title">
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<textarea id="todo-content" class="form-control" rows="6" cols="10"
						v-model="content" name="content"></textarea>						
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('complete', 'complete', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<select v-model="complete" class='form-control'>
							<?php foreach($complete_items as $idx => $item){?>
							<option value="{{$idx}}">{{$item}}</option>							
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						<button class="btn btn-outline-primary" v-on:click="send_post">保存
						</button>					
					</div>
				</div>
		</div>
		<hr />
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button class="btn btn-outline-danger" v-on:click="delete_todo">Delete
				</button>					
			</div>
		</div>		
		<br />
		<div class="panel-footer">
			{{ link_to_route('vue_todos.index', '戻る', null, ["class" => "btn btn-outline-primary" ]) }}
		</div>
		<hr />

	</div>
</div>
<!-- -->
<script>
var task_id= {{$task_id}};
//
new Vue({
	el: '#app',
	created () {
	},  
	mounted: function() {
		this.getItem();
	},      
	data: {
		item: null,
		id: 0,
		title: '',
		content  : '',
		complete : 0,
//		selected : 0,
	},
	methods: {
		getItem: function() {
			var task = {
				"id" : {{$task_id}},
			};
			axios.post('/api/apitodos/get_item' ,task).then(res => {
				this.item = res.data;
				this.id = this.item.id;
				this.title = this.item.title;
				this.content = this.item.content;
				this.complete = this.item.complete;
//					this.content= marked(this.content);
console.log(this.item  );                
// console.log(res.data.id );
//                window.location.href = '/tasks';
			});
		},
		send_post(){
			var task = {
				'id': this.id,
				'title': this.title,
				'content': this.content,
				'complete' : this.complete,
			};
			axios.post('/api/apitodos/update_todo' , task ).then(res => {
				console.log(res.data );
				window.location.href = '/vue_todos';
			});
		},
        delete_todo(){
            var task = {
                "id" : task_id,
            };
            axios.post('/api/apitodos/delete_todo' ,task).then(res => {
                console.log(res.data.id );
                window.location.href = '/vue_todos';
            });

        },		 			        
	}
});
//
$(function() {});
</script>
@endsection
