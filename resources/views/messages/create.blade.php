
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading" style="margin-top: 10px;">
			{{ link_to_route('messages.index', '戻る', null, 
			['class' => 'btn btn-outline-primary'] ) }}
			<br />
			<h3 class="" style="margin-top: 8px;">Message - 新規作成</h3>
		</div>
		<hr class="mt-0 mb-0" />
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
			<div class="form-group">
				<div class="col-sm-12">
					<!-- 					<p style="color: green;">送信先を検索下さい。</p>
					-->
					<p class="mb-2">mail : <span style="color: green;">送信先を検索下さい。</span></p> 
					<div class="mail_item">
						<div class="col_mail_text col-sm-6">
							<input type="email" class="form-control" id="title" v-model="mail"
							placeholder="hoge@aaa.com" />
						</div>
						<div class="col_search_btn">
							<button class="btn btn-outline-primary btn-sm" v-on:click="search_user">Search
							</button>
						</div>
					</div>
				</div>
			</div>
			<form action="/messages" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
			<div class="form-group">
				<div class="col-sm-6">
					{!! Form::hidden('to_id', null, [
						 'class' => "form-control",
						 'id' => 'to_id'  ]) 
					!!}
				</div>
			</div>
			<div class="form-group">
				<div class="sent_user_wrap" style="display:none;">
					<hr class="mt-2 mb-2" />
					送信先 :
					<div class="col-sm-8">
						{{Form::checkbox('check_1', 1, true)}} @{{user.name}}  / @{{user.email}} <br />
					</div>
				</div>
			</div>
			<hr class="mb-2" />		
			<div class="form-group">
				<?php $class_title = "form-control";
				?>
				{!! Form::label('title', 'タイトル:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-8">
					{!! Form::text('title', $message->title, [
						'id' => 'message-title', 'class' => $class_title ,'required'=>'required' ]) 
					!!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('content', '本文:', ['class' => 'col-sm-3 control-label']) !!}
				<div class="col-sm-8">
					{!! Form::textarea('content', $message->content, [
						'id' => 'message-content', 'class' => 'form-control',
						'rows' => 10,'cols' => 10,
						'required'=>'required'
					]) !!}
				</div>
			</div>
			<hr class="mt-2 mb-2"/>
			<div class="form-group">
				Attach file :
				<div class="col-sm-8">
					<input type="file" value="Select File" name="attach_file"
					class="btn btn-outline-primary" />
				</div>				
			</div>			
			<hr />
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6 sumit_btn">
					{!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
		<!-- <hr /> -->
		<br />
		<div class="panel-footer">
		</div>
	</div>
</div>

<!-- -->
<script>
var USER_ID = 0;
var TIMER_COUNT = 0;
var TIMER_COUNT_MAX = 60;
//
new Vue({
	el: '#app',
	created () {
		this.get_items(USER_ID);
		this.user= {
			id: 0, 
			name:"",
		}
	},    
	data: {
		mail: "",
		user : null,
		/*
		user: {
			id: "",
			name: "",
			email: "",
		},
		*/
		items : [],
		timerObj : null,
	},
	methods: {
		get_items(USER_ID) {
			var data = {
				'user_id': USER_ID,
				'type': 1,
			};           
			axios.post('/api/apimessages/get_item' , data).then(res =>  {
				this.items = res.data
//console.log(res.data );
			});             
		},
		search_user(){
console.log(this.mail );
		var data = {
				'mail': this.mail,
			};           
			axios.post('/api/apimessages/get_user' , data).then(res =>  {
				this.user = res.data
console.log(res.data );
				if(this.user.id != null){
//console.log(this.user.id);
					$("#to_id").val(this.user.id);
					$('.sumit_btn').css('display','inherit');
					$('.sent_user_wrap').css('display','inherit');
				}else{
					alert("nothig user, for mail");
				}
			});
		},
	}
});
</script>
<!-- -->
<style>
.sumit_btn{ display: none}
/* mail_search */
.mail_item{
	display:flex;
	flex-wrap: wrap;
	/* 	border-bottom: 1px solid #000; */
}

</style>
@endsection
