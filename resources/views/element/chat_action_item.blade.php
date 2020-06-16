<div class="action_btn_wrap" style="text-align: right;">
	<!--
	<a href="/chats"
		class="btn btn-outline-primary btn-sm mb-2">
		<i class="fas fa-redo-alt"></i>Load
	</a>							
	-->
	<div class="btn-group mb-2" >
		<!--  style="float: left;" -->
		<button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?php //var_dump( count($messages) ); btn-lg ?>
			<i class="fas fa-bars"></i>
		</button>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="/chats/info_chat?id={{$chat->id}}">Chat info
			</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/chats/csv_get?chat_id={{$chat->id}}">CSV 出力
			</a>
		</div><!-- /.dropdown-menu -->

	</div><!-- /.btn-group -->		
	<?php if($user->id == $chat->user_id){ ?>
		<a href="/chats/<?= $chat->id ?>/edit"
			class="btn btn-outline-primary btn-sm mb-2"
			data-toggle="tooltip" title="edit chat">
		<i class="far fa-edit"></i></a>
	<?php } ?>
	<a href="/chats/delete_member?cid={{$chat->id}}"
		class="btn btn-outline-danger btn-sm mb-2">退会
	</a>

</div>
