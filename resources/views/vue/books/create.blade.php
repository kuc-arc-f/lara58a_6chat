
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
<div id="app">
	<div class="panel panel-default">
		<br />
		<div class="panel-heading">
			<h1>新規作成</h1>
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
			{!! Form::model($book, [
				'route' => 'books.store', 'method' => 'post', 'class' => 'form-horizontal'
			]) !!}
			{!! Form::close() !!}			
			<div class="form-group">
				{!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-6">
					<input type="text" class="form-control" id="title"
					 v-model="title" required="required" placeholder="タイトル入力下さい">
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('content', 'content:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-6">
					<input type="text" class="form-control" id="content" v-model="content">
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('type', 'type：', ['class' => 'col-sm-3 control-label']) !!}
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
				<div class="col-sm-6">
					<input type="date" name="date_1" class="form-control"
					v-model="date_1"  />
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('radio_1', 'ラジオ_1:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-4">
					<div class="radio_wrap" v-for="radio_item in radio_items" v-bind:key="radio_item.id">
						<input type="radio" name="radio_1" v-model="radio_1" v-bind:value="radio_item.id" />						
						@{{radio_item.value}}<br />
					</div>
				</div>
				<!--
				<span>radio_1: @{{ radio_1 }}</span>
				-->
			</div>    
			<div class="form-group">
				{!! Form::label('check_1', 'チェクボックス:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-4">
					<input type="checkbox" id="checkbox" v-model="check_1">CH_1  <br />
					<input type="checkbox" id="checkbox" v-model="check_2">CH_2  <br />
				</div>
			</div>   
	
			<br />
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button class="btn btn-outline-primary" v-on:click="send_post">投稿
					</button>
				</div>
			</div>
		</div>
		<hr />
		<br />
		<div class="panel-footer">
			{{ link_to_route('vue_books.index', '戻る' ,null, ['class' => 'btn btn-primary'] ) }}
		</div>
	</div>
</div>
<!-- -->
<script>
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
		console.log(this.radio_items );
	},    
	data: {
		title :'',
		content: '',
		type : 0,
		select_items : select_array,
		radio_items : radio_array,
		radio_1 : 1,
		check_1 : 1,
		check_2 : 1,
		date_1 : null,
	},
	methods: {
		send_post(){
			var task = {
				'title': this.title,
				'content': this.content,
				'type' : this.type,
				'radio_1' : this.radio_1,
				'check_1' : this.check_1,
				'check_2' : this.check_2,	
				'date_1' : this.date_1,			
			};
			axios.post('/api/apibooks/create_book' , task ).then(res => {
console.log(res.data );
				window.location.href = '/vue_books';
			});
		},        
	}

});
</script>

@endsection
