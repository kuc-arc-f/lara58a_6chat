@extends('layouts.app')
@section('title', ' ')

@section('content')
<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-sm-6"><h3>Messages - index</h3>
				</div>
				<div class="col-sm-6" style="text-align: right;">
					{{ link_to_route('messages.create', 'Create' ,null, 
					['class' => 'btn btn-primary']) }}
				</div>
			</div> 
		</div>
		<hr class="mt-2 mb-2">
		<div class="panel-body">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a href="#" class="nav-link active" id="nav_receive_tab" v-on:click="change_type(1)">
						Receive
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" id="nav_sent_tab" v-on:click="change_type(2)">
						Sent
					</a>
				</li>
			</ul>

			<table class="table table-striped item-table">
				<thead>
					<th>ID</th>
					<th>Title</th>
				</thead>
				<tbody>
					<tr v-for="item in items" v-bind:key="item.id">
						<td class="table-text">@{{ item.id }}
						</td>
						<td class="table-text col_title">
							<div class="title_wrap">
								<span v-if="item.status==1" >
									<i class="far fa-envelope"></i>
								</span>
								<span v-if="mode==1">
									<a v-bind:href="'/messages/' + item.id">
										@{{ item.title }}
									</a>
								</span>
								<span v-else>
									<a v-bind:href="'/messages/show_sent?id=' + item.id">
										@{{ item.title }}
									</a>
								</span>								
							</div>
							<span class="date_str" style="margin-top:0px;">@{{ item.date_str }}
							</span>
							<span v-if="mode==1" class="date_str">, from @{{item.user_name}}
							</span>							
							<span v-if="mode==2" class="date_str">
								, To @{{item.user_name}}
							</span>							
						</td>
					</tr>                    
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- info -->
<br />
@include('element.page_info',
[
	'git_url' => ' ',
	'blog_url' => ' '
])
<!-- -->
<script>
var USER_ID = {{$user->id}};
var TIMER_COUNT = 0;
var TIMER_COUNT_MAX = 60;
var MODE_RECEIVE = 1;
var MODE_SENT = 2;
//
new Vue({
	el: '#app',
	created () {
		this.get_items(USER_ID);
	},    
	data: {
		items : [],
		timerObj : null,
		mode : MODE_RECEIVE,
	},
	methods: {
		get_items(USER_ID) {
			var data = {
				'user_id': USER_ID,
				'type': 1,
			};           
			axios.post('/api/apimessages/get_item' , data).then(res =>  {
				this.items = res.data
//console.log(this.items );
				this.mode = MODE_RECEIVE;
			});             
		},
		get_sent_item: function() {
			var data = {
				'user_id': USER_ID,
				'type': 1,
			};           
			axios.post('/api/apimessages/get_sent_item' , data).then(res =>  {
				this.items = res.data
//console.log(res.data );
				this.mode = MODE_SENT;
			});
		}, 
		change_type: function(type) {
console.log(type );
			if(type == MODE_RECEIVE){
				$('#nav_receive_tab').addClass('active');
				$('#nav_sent_tab').removeClass('active');	
				this.get_items(USER_ID);			
			}else{
				$('#nav_sent_tab').addClass('active');
				$('#nav_receive_tab').removeClass('active');
				this.get_sent_item();
			}
		},
	}
});
</script>
<!-- -->
<style>
.item-table .col_title{
	font-size: 1.4rem;
}
.item-table .from_user_name{
	font-size: 1.2rem;
	/* margin-left: 32px; */
}
.item-table .date_str{ font-size: 0.84rem; }
.item-table td{ padding : 8px;}
</style>

@endsection
