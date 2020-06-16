@extends('layouts.app')
@section('title', 'chat')

@section('content')
<?php
function valid_member($chat_id , $chat_members){
    $ret = false;
    foreach($chat_members  as $chat_member ){
        if($chat_id == $chat_member->id){
            $ret = true;
//debug_dump($chat_member->id);
        }
    }
    return $ret;
}
?>
<div class="row">
    <div class="col-sm-3">
        @include('element.chat_left_area',
        [
            'join_chats' => $join_chats,
        ])         
    </div>
    <div class="col-sm-9">
        <div class="panel panel-default" style="margin-top: 16px;">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
            @endif    
            <div id="app">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6" style="text-align: center;">
                            @include('element.chat_notify',[])
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            {{ link_to_route('chats.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                </div>        
                <hr class="mb-2 mt-2" />
                <!-- tab -->
                <?php
                $tab_select_join_disp = "";
                $tab_select_all_disp = "";
                if($disp_mode == 1){
                    $tab_select_join_disp = "active";
                }        
                if($disp_mode == 2){
                    $tab_select_all_disp = "active";
                }
                ?>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#" class="nav-link <?= $tab_select_all_disp?>" v-on:click="move_disp_mode(2)">
                            All chat
                        </a>
                    </li>
                </ul>
                <?php if($disp_mode == 2){ ?>
                    <!-- 
                    <hr class="mb-2 mt-2" />
                    -->
                    <div class="row" style="margin-top: 10px;">            
                        <?php //debug_dump($params);
                        $key_name = "";
                        if(isset($params["name"])){
                            $key_name = $params["name"];
                        }
                        ?>        
                        <div class="col-sm-12" style="padding-bottom: 8px;">
                            {!! Form::model(null, [
                                'route' => 'chats.search_index', 'method' => 'post', 'class' => 'form-horizontal'
                            ]) !!}
                            {!! Form::text('name', $key_name , [
                                'id' => 'chat-name', 'class' => 'form-control search_key' ,
                                'placeholder' => 'Search Keyword',
                                'style' => 'margin-right : 10px;']) 
                            !!}    
                    
                            {!! Form::submit('Search', ['class' => 'btn btn-outline-primary btn-sm serach_button']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                <?php } ?>
            </div>    
            <div class="panel-body">
                <?php // var_dump($user->id ); ?>
                <table class="table table-striped chat-table">
                    <thead>
                        <!-- 
                        <th>Id</th>
                        <th>Create</th>
                        <th>Open</th>
                        <th>action</th>
                        -->
                        <th>Name</th>
                        <th>Join</th>
                    </thead>
                    <?php //debug_dump($tasks); ?>
                    <tbody>
                        @foreach ($chats as $chat )
                        <?php
                            $valid = valid_member($chat->id , $chat_members);
                            //var_dump($valid);
                        ?>
                            <tr>
                                <td class="table-text">
                                    <p class="p_tbl_chat_name mb-0">
                                        {{ link_to_route('chats.show', $chat->name, $chat->id, ) }}
                                    </p>
                                    <span>
                                        ID : {{$chat->id}} ,
                                        <?= $chat->created_at->format('Y-m-d') ?> 
                                        &nbsp;
                                        <a href="/chats/info_chat?id=<?= $chat->id ?>" data-toggle="tooltip" title="information chat">
                                            <i class="fas fa-info-circle"></i>
                                        </a>  
                                        <?php if($user->id == $chat->user_id){ ?>
                                            &nbsp;&nbsp;
                                            <a href="/chats/<?= $chat->id ?>/edit"
                                                data-toggle="tooltip" title="edit chat">
                                            <i class="far fa-edit"></i></a>
                                        <?php } ?>
                                    </span>
                                </td>
                                <td class="table-text">
                                    <?php if($valid){ ?>
                                        <a href="/chats/delete_member?cid={{$chat->id}}"
                                            class="btn btn-outline-danger btn-sm">退会
                                        </a>
                                    <?php }else{ ?>
                                        <a href="/chats/add_member?cid={{$chat->id}}"
                                            class="btn btn-outline-primary btn-sm">参加
                                       </a>
                                    <?php }?>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <!-- paginater -->
                {{ $chats->links() }}
                <br />
                <hr />
            </div><!-- end_panel-body -->
            <div class="panel-footer">
            </div>
        </div>
    </div><!-- end_main_col -->
</div><!-- end_row -->

<!-- chat_footer -->
<div class="chat_foot_wrap">
    @include('element.page_info',
    [
        'git_url' => 'https://github.com/kuc-arc-f/lara58a_6chat',
        'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_13chat'
    ])        
</div>

<!-- -->
<style>
.search_key{
    width: 200px; 
    float: left;
}
.serach_button{}
.p_tbl_chat_name{ font-size: 1.4rem; }
.chat-table td{ padding : 8px;}
</style>
<!-- -->
<script>
const USER_ID  ="{{$user_id}}";
//
new Vue({
	el: '#app',
	data: {
//		message: '',
		notify_items : [],
	},
	created:function(){
		this.get_notify_menu(USER_ID);
	},
	methods: {
		get_notify_menu(USER_ID) {
			axios.get('/api/apichats/get_notify_menu?user_id=' +USER_ID)
			.then(res =>  {
				var items = res.data;
				var new_items = [];
				items.forEach(function(item){
					new_items.push(item);
				});
				this.notify_items = new_items;
//console.log( this.notify_items )
			})
		},
		move_chat: function(chat_id) {
//			console.log(chat_id);
			location.href= '/chats/' + chat_id;
		},  
		move_disp_mode: function(mode) {
//			console.log(chat_id);
			location.href= '/chats?mode=' + mode;
		},          

	}
});

</script>    

@endsection
