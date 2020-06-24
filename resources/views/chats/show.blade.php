@extends('layouts.app')
@section('title', $chat->name )

@section('content')
<link rel="manifest" href="/manifest.json">
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js"></script>
<script src="/js/chat_show.js?A3"></script>
<script src="/js/fcm_init.js?B2"></script>

<!-- -->
<div class="row">
    <div class="col-sm-3">
        @include('element.chat_left_area',
        [
        ])         
    </div>
    <div class="col-sm-9">
		<!-- -->
		<div id="app">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-6">
							<h3>{{$chat->name}}</h3>
							<p class="mb-2">ID : {{$chat->id}} </p>
						</div>
						<div class="col-sm-3 pt-2" style="text-align: center; ">
							<a href="/chats"
								class="btn btn-outline-primary">
								<i class="fas fa-redo-alt"></i> Load
							</a>							
						</div>
						<div class="col-sm-3" style="text-align: center; ">
							@include('element.chat_notify',[]) <br />
							<!-- action -->
							<div class="mt-2" style="text-align: right; ">
								@include('element.chat_action_item', []) 
							</div>
						</div>
					</div>

					<hr class="mt-0 mb-2"/>
					<!-- input_area -->
					<div class="input_area_wrap" style="text-align: center;">
						<div class="row">
							<div class="col-sm-6" style="text-align: right;">
								<!--  mb-0 -->
								<textarea v-model="message" class="form-control mt-0"
								style="padding :12px; 0px;"
								rows="3" cols="40" id="send_text"
								v-on:click="input_active();"
								placeholder="please Input" required="required"></textarea>                        
							</div>
							<div class="col-sm-6" style="text-align: left;">
								<button @click="addItem" id="send_button" class="btn btn-primary"
								data-toggle="tooltip" title="send post">Post
								</button>                        
							</div>
						</div>
					</div>
					<hr class="mt-2 mb-2">	
					<!-- post-list -->
					<ul class="ul_post_box" style="list-style: none;">
						<li v-for="task in tasks" v-bind:key="task.id">
							<div v-bind:class="'post_item'+' '+ task.item_bg"
								v-on:click="open_modal(task.id)">
								<div class="col_name">
									<div class="post_user_wrap">
										<!--  class="pl-2" -->
										<span style="font-size: 42px; float: left; padding: 0px;">
											<div v-if="task.is_other">
												<i class="far fa-meh"></i>	
											</div>
											<div v-else style="color: #616161;  padding: 0px;">
												<i class="fas fa-meh" style="margin: 0px;"></i>
											</div>
										</span>
										<div class="time_box pl-1" >
											<p class="mb-0">
												@{{ task.user_name }}:<br /> 
												@{{ task.date_str }}

												<!-- ID: @{{ task.id }} -->
											</p>
										</div>
									</div>
								</div>
								<div class="col_body">
									<p class="li_p_box mb-0" v-html="task.body">
									</p>							 
								</div>
							<div>
						</li>
					</ul>
					<!--
					<hr />
					{{ link_to_route('chats.index', '戻る', null, ["class" => "btn btn-outline-primary"]) }}
					-->
				</div>

				<!-- -->    
				<div class="token_wrap" style="display: none;">
					<p>
						title:
						<input type="text" value="title-123" id="send_title">
					</p>
					<hr />
					<p>
						IID_TOKEN:
						<input type="text" value="YOUR-INCETANCE-ID-TOKEN" id="textInstanceIdToken"
						style="width:100%;box-sizing:border-box;">
					</p>
				</div>
			</div>
			<!-- modal -->	
			<div class="modal fade" id="modal1" tabindex="-1"
				role="dialog" aria-labelledby="label1" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="label1">
							@{{ modal_item.user_name }} : @{{ modal_item.date_str }}
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						ID: @{{modal_item.id}}
						<pre class="modal_body_text" v-html="modal_item.body_org"></pre>
						<div v-if="delete_ok">
							<hr />
							<span style="font-size: 24px; color: #f44336;" class="pl-2">
								<i v-on:click="open_delete(modal_item.id)" class="far fa-trash-alt"></i>
							</span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					</div><!-- modal-content -->
				</div><!-- modal-dialog -->
			</div><!-- modal -->

		</div><!-- app -->  
	</div>
</div>

<!-- -->
<div class="time_text_wrap" style="display: none;">
	watch-test:
	<input type="text" id="time_text" value="" />
</div>
<!-- -->
<div class="panel panel-default">
	<hr />
	<div class="panel-footer">
		<br />
		<br />
	</div>
	@include('element.page_info',
	[
		'git_url' => 'https://github.com/kuc-arc-f/lara58a_6chat',
		'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_13chat'
	])
</div>

<!-- -->
<style>
.ul_post_box .bg_gray{	background: #EEE; }
.modal_body_text{
	border: 1px solid #000;
	background: #EEE;
	padding : 10px;
}
.post_item{
	display:flex;
	flex-wrap: wrap;
	border-bottom: 1px solid #000;
}
.post_item .col_name{
	/* max-width : 200px; 
	padding : 10px; */
	padding : 0px 8px;
	width : 180px;
}
.li_p_box{
	padding : 10px;
}
.time_box{
	margin-left : 52px;
	/* height: 62px;
	height: 42px;
	 */
	padding: 8px;
	color: gray;
	font-size: 0.875rem;
}
.hr_post_bottom{
	height: 10px;
	width : 100%;
    background-color: #000;
    border: none;	
}
/* input */
#send_button{	margin : 30px 10px;	}
/* notify_menu */
.notify_menu_wrap .dropdown-item a{
	/* color: gray; */
	padding : 0px;
	font-size: 0.875rem;
}

</style>
<!-- -->
<script>
const CHAT_MEMBER_ID  ="{{$chat_member->id}}";
const CHAT_ID  ="{{$id}}";
const USER_ID  ="{{$user_id}}";
var messaging = null;
var FCM_SERVER_KEY = "";
var IID_TOKEN ="";
const textInstanceIdToken = document.getElementById('textInstanceIdToken');
const elem_title = document.getElementById('send_title');
const elem_body = document.getElementById('send_body');

var CHAT_MEMBERS = [];
@foreach ($chat_members as $item )
	var data = {
			'user_id': {{$item->user_id}},
			'token': "{{$item->token}}",
		};
	CHAT_MEMBERS.push(data);
@endforeach

//init
set_time_text();
var TIME_TEXT_STR = $("input#time_text").val();
//
new Vue({
		el: '#app',
	data: {
		message: '',
		tasks : [],
		modal_item : [],
		delete_ok : 0,
		input_expand_none: 0,
		notify_items : [],
		timerObj : null,
	},
	created:function(){
		this.get_posts(USER_ID);
		this.timer_start();
	},
	methods: {
		update() {
			this.message = '';
		},
		input_active() {
// console.log(this.input_expand_none );
			$("#send_text").css('height','200px');
//			$("#send_text").css('margin-bottom','10px');
		},
		open_delete: function(id) {
			var item = {
                'id': id,
            };
            axios.post('/api/apichats/delete_post' , item ).then(res => {
                console.log(res.data );
                window.location.href = '/chats/'+ CHAT_ID;
            });			
		},
		open_modal: function(id) {
			var item = this.get_modal_data(id, this.tasks );
			this.modal_item = item;
			$('#modal1').modal('show');
			this.delete_ok = 0;
			if(item.user_id == USER_ID){
				this.delete_ok = 1;
			}
		},
		move_chat: function(chat_id) {
//			console.log(chat_id);
			location.href= '/chats/' + chat_id;
		},
		get_modal_data(id, items ) {
			var ret = null;
			items.forEach(function(item){
				if(item.id == id){
					ret = item;
				}
				//console.log(item.id);
			});
			return ret;
		},
		get_posts(USER_ID) {
			axios.get('/api/apichats/get_post?cid=' +CHAT_ID)
			.then(res =>  {
				var items = res.data;
				var new_items = [];
				items.forEach(function(item){
					if(item.user_id == USER_ID){
						item.is_other = 0;
						item.item_bg = 'bg_gray';
					}else{
						item.is_other = 1;
						item.item_bg = '';
					}
					new_items.push(item);
				});
//console.log( new_items  )
				this.tasks  = new_items;
//				this.timer_start();
				this.get_notify_menu(USER_ID);
			})            
		},
		get_notify_menu(USER_ID) {
			axios.get('/api/apichats/get_notify_menu?user_id=' +USER_ID)
			.then(res =>  {
				var items = res.data;
				var new_items = [];
				items.forEach(function(item){
					new_items.push(item);
				});
				this.notify_items = new_items;
// console.log( this.notify_items )
			})
		},
		addItem() {
			console.log(this.message );
			if(this.message !=''){
				update_post(this.message , CHAT_ID ,USER_ID);
				set_time_text();
				$("#send_text").css('height','90px');
			}else{
				alert("text input, require..");
			}
			this.message='';
		},
		count: function() {
			var chk_time = $("input#time_text").val();
//console.log(TIME_TEXT_STR );
//console.log( "chk=" + chk_time);
			if(TIME_TEXT_STR != chk_time){
				console.log( "#change_time");
				this.get_posts(USER_ID);
				TIME_TEXT_STR = $("input#time_text").val();
			}
		},
		timer_start: function() {
			var self = this;
			this.timerObj = null;
			this.timerObj = setInterval(function() {self.count()}, 3000)
		},
	}
});
//init
var AppConst = {
	"messagingSenderId" : "",
	"PublicVapidKey" : "",
	"FCM_SERVER_KEY" : "",
}
var data = { 
	'param1': 1, 
	'mail': '<?= $SUPER_USER_MAIL ?>', 
	'password': 'password' 
};
axios.post('/api/apisystem/get_fcm_init' , data ).then(res => {
	var resParams = res.data.params;
	var params ={
		"messagingSenderId" : resParams.FCM_messagingSenderId,
		"PublicVapidKey" : resParams.FCM_PublicVapidKey,
		"FCM_SERVER_KEY" : resParams.FCM_SERVER_KEY
	};
	AppConst = params;
	fcm_init_proc();
//console.log( AppConst );
});

/**********************************************
 *
 *********************************************/
 function fcm_init_proc(){
	firebase.initializeApp({
		'messagingSenderId': AppConst.messagingSenderId
	});
	messaging = firebase.messaging();
	messaging.usePublicVapidKey(AppConst.PublicVapidKey );
	FCM_SERVER_KEY = AppConst.FCM_SERVER_KEY ;
	fcm_get_token(CHAT_MEMBER_ID);
	fcm_onMessage();
}
/**********************************************
 *
 *********************************************/    
 function set_time_text(){
	var date = new Date();
	var iso_date = date.toISOString();
	$("input#time_text").val( iso_date );
 }
/**********************************************
 * recv
 *********************************************/    
function fcm_onMessage(){
	messaging.onMessage((payload) => {
//        console.log('Message received. ', payload);
		var notify = payload.notification;
		recv_pushMessage("", notify.body);
		//get_receiveUserId( notify.title );
		var data = {
			'id' : 0,
			'chat_id': CHAT_ID ,
			'user_id': 0,
			'body': notify.body,
			'created_at': null,
		};
		set_time_text();
//		console.log(notify.title );
		console.log(notify.body );
	});
}
</script>

@endsection
