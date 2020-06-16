<div class="chat_left_wrap" style="margin-top: 10px;">
	<h3>Chat </h3>
	<?php if(isset($version)){ ?>
		<p>version : <?= $version ?>
		</p>
	<?php } ?>
	<!-- -->
	<div class="left_menu_wrap">
		<div class="menu_home">
			<!-- /chats -->
			<a href="/chats/home" class="btn btn-outline-primary">
				<i class="fas fa-home"></i> Chat Home
			</a>
		</div>

		<div class="menu_join_chat" style="margin-top: 20px;">Join Chat
		</div>
		<div class="left_chats_wrap" style="padding-top:10px;">
			@foreach ($join_chats as $chat )
			<p class="li_join_chat">
				{{ link_to_route('chats.show', $chat->name, $chat->id, ) }}
			</p>
			@endforeach

			<div class="join_chat_wrap">
			</div>
		</div>
	</div>
</div>
<!-- -->
<style>
.menu_home{ background: #fff; }
.menu_join_chat{
	padding: 10px;
	background: #EEE; 
}

.li_join_chat{ /*padding: 10px; */ 
	border-bottom: 1px solid #000; 
} 
/* 
*/
</style>
