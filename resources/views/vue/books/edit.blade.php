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
				<div class="form-group">
					{!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<input type="text" class="form-control" id="title"
						 v-model="title" required="required">
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<input type="text" class="form-control" id="content" v-model="content">
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('type', 'type', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<select v-model="type" id="type" required="required" name="type" class="form-control">
							<option value="">選択下さい</option>
							<option v-for="select_item in select_items" v-bind:key="select_item.id"
								v-bind:value="select_item.id">@{{select_item.value}}
							</option>
						</select>					
					</div>
				</div>   
				<!--date -->
				<div class="form-group">
					{!! Form::label('date_1', '日付_1', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-4">
						<input type="date" name="date_1" class="form-control"
						v-model="date_1"  />					
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('radio_1', 'radio_1', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-4">
						<div class="radio_wrap" v-for="radio_item in radio_items" v-bind:key="radio_item.id">
							<input type="radio" v-model="radio_1" v-bind:value="radio_item.id" />						
							@{{radio_item.value}}<br />
						</div>
						
					</div>
				</div>    
				<div class="form-group">
					{!! Form::label('check_1', 'check_1', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-4">
						<input type="checkbox" id="checkbox" v-model="check_1">CH_1  <br />
						<input type="checkbox" id="checkbox" v-model="check_2">CH_2  <br />					
					</div>
				</div>            
				<!-- -->
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						<button class="btn btn-primary" v-on:click="postTask">投稿
						</button>					
					</div>
				</div>
				<hr />
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						<button class="btn  btn-outline-danger"  v-on:click="deleteTask">Delete
						</button>
					</div>
				</div>
				
		</div>
		<hr />
		<div class="panel-footer">
			{{ link_to_route('vue_books.index', '戻る' ,null, ['class' => 'btn btn-outline-primary'] ) }}
		</div>
	</div>
	<br />
	<br />
</div>

<!-- -->
<script>
var book_id= {{$book_id }};
var select_array = [];
var radio_array = [];
<?php foreach($select_items as $idx => $item){ ?>
	select_array.push({
		"id" : <?= $idx ?>,
		"value" : "<?= $item ?>",
	});
<?php } ?>
<?php foreach($radio_items as $idx => $item){ ?>
	radio_array.push({
		"id" : <?= $idx ?>,
		"value" : "<?= $item ?>",
	});
<?php } ?>
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
		title: '',
		content  : '',
		type : 0,
		select_items : select_array,
		radio_items : radio_array,
		radio_1 : 0,
		check_1 : 0,
		check_2 : 0,
		date_1 : null,		
	},
	methods: {
		getItem: function() {
			var task = {
				"id" : book_id,
			};
			axios.post('/api/apibooks/get_item' ,task).then(res => {
				this.item = res.data;
				this.title = this.item.title;
				this.content = this.item.content;
				this.date_1 = this.item.date_1;
				this.type = this.item.type;				
				this.radio_1 = this.item.radio_1;				
				this.check_1 = this.item.check_1;				
				this.check_2 = this.item.check_2;				
console.log(this.item  );                
				console.log(res.data.id );
			});
		},
		postTask(){
			var task = {
				"id" : book_id,
				'title': this.title,
				'content': this.content,
				'date_1': this.date_1,
				'radio_1': this.radio_1,
				'check_1': this.check_1,
				'check_2': this.check_2,
				'type': this.type,								
			};
			axios.post('/api/apibooks/update_post' ,task).then(res => {
				console.log(res.data);
				window.location.href = '/vue_books';
			});
		}, 
		deleteTask(){
			var task = {
				"id" : book_id,
			};
			axios.post('/api/apibooks/delete_task' ,task).then(res => {
				console.log(res.data.id );
				window.location.href = '/vue_books';
			});

		},
	}
});
</script>
@endsection
