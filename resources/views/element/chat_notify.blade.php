<div class="btn-group notify_menu_wrap" data-toggle="tooltip" title="通知リスト表示できます">
    <!-- btn-outline-warning btn-lg  mb-2 -->
    <button type="button" class="btn btn-sm btn-success dropdown-toggle"
     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-bell"></i>
    </button>
    <div class="dropdown-menu">
        <div class="dropdown-item pl-4 pr-4" 
            v-for="item in notify_items" v-bind:key="item.id">
            <a v-on:click="move_chat(item.chat_id)">
                <span class="notify_menu_text mb-0">
                    @{{item.chat_name}} / @{{item.user_name}}<br />
                    @{{item.body}}<br />
                    @{{item.date_str}}
                </span>
            </a>
            <div class="dropdown-divider notify_menu_line mt-0 mb-0"></div>
        </div>
    </div><!-- /.dropdown-menu -->
</div><!-- /.btn-group -->
