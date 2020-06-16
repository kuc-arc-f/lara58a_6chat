@extends('layouts.app')
@section('title', 'messages')

@section('content')
<script src="/js/message.js?A1"></script>
<div id="app">
	<div class="flash_message bg-warning text-center py-3 my-0" 
		id="message_index_flash_wrap" style="display: none;">
		<p class="mb-0" id="message_index_flash">@{{flash_message}}</p>
	</div>	
	<div class="panel panel-default" style="margin-top: 10px;">
		<div class="panel-heading">
			<div class="row">
				<!--  - index -->
				<div class="col-sm-4"><h3>Messages</h3>
				</div>
				<div class="col-sm-4" style="">
					{{ link_to_route('messages.create', 'Create' ,null, 
					['class' => 'btn btn-primary']) }}
				</div>
				<!-- text-align: left; -->
				<div class="col-sm-4" style="padding-top: 8px;">
					<a href="/messages"
						class="btn btn-outline-primary btn-sm" style="float :left;">
						<i class="fas fa-redo-alt"></i> Reload
					</a>
					<span class="search_btn_wrap" style="margin-left : 10px;">
						<a href="#" class="btn btn-sm btn-outline-primary serach_display_btn mb-0">
							<i class="fas fa-arrow-down serach_display_btn"></i>&nbsp;Search
						</a>
					</span>
				</div>
			</div> 
		</div>
		<hr class="mb-2 mt-2" />
		<!-- 
		<p class="serach_display_btn"><i class="fas fa-arrow-down "></i>
			Search<br />
		</p>
		-->
		<div class="search_wrap mt-2" style="display: none; ">
			<div class="row  mb-0" >            
				<div class="col-sm-4">
					<input type="text" class="form-control" placeholder="title"
					v-model="search_key">
				</div>
				<div class="col-sm-4">
					<input type="text" class="form-control" placeholder="mail"
					v-model="search_mail">
				</div>				
				<div class="col-sm-4">
					<a href="#" class="btn btn-primary btn-sm"
					v-on:click="searchTasks()" >Search Go
					</a>
				</div>
			</div>		
			<hr class="mb-2 mt-2" />
		</div>
		<!-- <hr class="mt-2 mb-2"> style="margin-top: 10px;" -->
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
			<ul class="ul_post_box" style="list-style: none;">
				<li v-for="item in items" v-bind:key="item.id">
					<div class="title_wrap">
						<span v-if="item.status==1" >
							<i class="far fa-envelope"></i>
						</span>
						<span v-if="mode==1">
							<a v-bind:href="'/messages/' + item.id">
								@{{ item.title }}
							</a>
							<br />
						</span>
						<span v-else>
							<a v-bind:href="'/messages/show_sent?id=' + item.id">
								@{{ item.title }}
							</a>
							<br />
						</span>	
						<!-- date -->
						<span class="date_str" style="margin-top:0px;">@{{ item.date_str }}
						</span>
						<span v-if="mode==1" class="date_str">, from @{{item.user_name}}
						</span>							
						<span v-if="mode==2" class="date_str">
							, To @{{item.user_name}}
						</span>	
						<span class="date_str">
							, ID: @{{ item.id }}
						</span>
										
					</div>
				</li>
			</ul>

		</div>
	</div>
</div>
<!-- -->
<div class="time_text_wrap" style="display: none;">
	watch-test:
	<input type="text" id="time_text" value="0" />
	<input type="text" id="message_title" value="" />
</div>
<!-- info -->
<br />
@include('element.page_info',
[
	'git_url' => 'https://github.com/kuc-arc-f/lara58a_7message',
	'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_26message'
])
<!-- -->
<script>
var USER_ID = {{$user->id}};
var TIMER_COUNT = 0;
var TIMER_COUNT_MAX = 60;
var MODE_RECEIVE = 1;
var MODE_SENT = 2;
var TIME_TEXT_STR = 0;
/**********************************************
 *
 *********************************************/    
 function valid_notification(){
	if (!('Notification' in window)) {//対応してない場合
		alert('未対応のブラウザです');
	}
	else {
		// 許可を求める
		Notification.requestPermission()
		.then((permission) => {
			if (permission === 'granted') {// 許可
			}
			else if (permission == 'denied') {// 拒否
				$("#message_index_flash_wrap").css('display','inherit');
				$("#message_index_flash").text("ブラウザ通知を許可に設定すると。自動更新の通知を受信できます。");
			}
			else if (permission == 'default') {// 無視
			}
//			console.log(permission);
		});
	}  
}
/**********************************************
 *
 *********************************************/    
 function set_time_text(){
	var data = {
				'user_id': USER_ID,
				'type': 1,
			};           
	axios.post('/api/apimessages/get_last_item' , data).then(res =>  {
		var item = res.data
		if(item.id != null){
			$("input#time_text").val( item.id );
			$("input#message_title").val( item.title );
		}else{
			$("input#time_text").val( 0 );
		}
console.log( item );
	});	 
 }
 set_time_text();
 //timer
var timer_func = function(){
	 set_time_text();
//console.log( TIME_TEXT_STR );
};
var TIMER_SEC = 1000 * 600;
//var TIMER_SEC = 1000 * 180;
setInterval(timer_func, TIMER_SEC );
var set_firstTimeText = function(){
	TIME_TEXT_STR = $("input#time_text").val();
console.log( "tm="+ TIME_TEXT_STR );
};
setTimeout(set_firstTimeText, 5000);

v = valid_notification();
//
new Vue({
	el: '#app',
	created () {
		this.get_items(USER_ID);
		this.timer_start();
	},    
	data: {
		items : [],
		timerObj : null,
		mode : MODE_RECEIVE,
		flash_message : "",
		search_key : "",
		search_mail : "",
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
//				TIME_TEXT_STR = $("input#time_text").val();
//console.log( "tm="+ TIME_TEXT_STR );
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
// console.log(type );
			if(type == MODE_RECEIVE){
//				$('.search_wrap').css('display','inherit');
				$('#nav_receive_tab').addClass('active');
				$('#nav_sent_tab').removeClass('active');	
				$('.search_btn_wrap').css('display','inherit');
				this.get_items(USER_ID);			
			}else{
				$('#nav_sent_tab').addClass('active');
				$('#nav_receive_tab').removeClass('active');
				this.get_sent_item();
				$('.search_wrap').css('display','none');
				$('.search_btn_wrap').css('display','none');
			}
		},
		count: function() {
			var chk_time = $("input#time_text").val();
//console.log("ct=" + TIME_TEXT_STR );
//console.log( "ct.chk=" + chk_time);
			if( parseFloat(TIME_TEXT_STR) != parseFloat(chk_time) ){
				console.log( "#change_time");
				if(this.mode == MODE_RECEIVE){
					var msg = $("input#message_title").val();
					display_notification("Recive Message", msg );
					this.get_items(USER_ID);
					TIME_TEXT_STR = $("input#time_text").val();
				}
			}
		},
		timer_start: function() {
			var self = this;
			this.timerObj = null;
			this.timerObj = setInterval(function() {self.count()}, 10000)
		},
        searchTasks(){
            var data = {
                'search_key': this.search_key,
				'user_id': USER_ID,
				'search_mail' : this.search_mail,
            };
            axios.post('/api/apimessages/search' , data ).then(res => {
console.log(res.data );
                this.items = res.data
//                this.convert_todos(this.items, this.complete)
            });
        },				
	}
});
$(function(){
	$( '.serach_display_btn' ).click( function() {
		// alert('serach_display_btn');
		$('.search_wrap').css('display','inherit');
	});
});
</script>
<!-- -->
<style>
.ul_post_box .date_str{ font-size: 0.84rem; }
.ul_post_box .title_wrap{
	/* font-size: 18px; */
	font-size: 1.32rem;
	border-bottom: 1px solid #000; 
	margin-top: 8px;
}
</style>

@endsection
