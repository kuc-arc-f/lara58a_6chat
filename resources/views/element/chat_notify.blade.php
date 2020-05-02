<div class="btn-group notify_menu_wrap mb-2" data-toggle="tooltip" title="通知リスト表示できます">
    <!-- btn-outline-warning -->
    <button type="button" class="btn btn-lg btn-outline-warning dropdown-toggle"
     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-bell"></i>
    </button>
    <div class="dropdown-menu">
        <div class="dropdown-item" href="#"
            v-for="item in notify_items" v-bind:key="item.id">
            <a class="dropdown-item" v-on:click="move_chat(item.chat_id)">
                @{{item.chat_name}} / @{{item.user_name}}<br />
                @{{item.body}}<br />
                <!-- 
                @{{item.date_str}}, ID: @{{item.id}}
                -->
            </a>
            <div class="dropdown-divider notify_menu_line mt-0 mb-0"></div>
        </div>
    </div><!-- /.dropdown-menu -->
</div><!-- /.btn-group -->
