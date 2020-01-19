@extends('layouts.app')

@section('title', "")

@section('content')

<link rel="manifest" href="/manifest.json">
<link href="/css/botui.min.css" rel="stylesheet">
<link href="/css/botui-theme-default.css" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js"></script>
<script src="/js/recv_notification.js?A4"></script>
<script src="/js/app_const.js?A1"></script>
<script src="https://unpkg.com/botui/build/botui.min.js"></script>

<!-- -->
<div class="panel panel-default">
    <!-- -->
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <p id="alert_message"></p>
    </div>
    @endif
    <div class="panel-body">
        <h1>Chat: {{$chat->name}}</h1>
        <p>chat-ID: {{$chat->id}} </p>
        <hr />
        <!-- botui -->
        <div class="botui-app-container" id="botui-app" style="height :400px; width : 90%;">
            <bot-ui></bot-ui>
        </div>
        <div style="text-align: center;">
            <div id="app">
                <div class="row">
                    <div class="col-sm-6" style="text-align: right;">
                        <textarea v-model="message" class="form-control"
                        rows="3" cols="40" id="send_text"
                        placeholder="入力下さい"></textarea>                        
                    </div>
                    <div class="col-sm-6" style="text-align: left;">
                        <button @click="addItem" id="send_button" class="btn btn-primary">投稿する</button>                        
                    </div>
                </div>
              </div>  
        </div>
        <br />
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
  
        <!--
        <hr />
        <a href="#" onClick="fcm_send_proc();">[ test ]</a>
        <br />
        fcm_send_member
        Send to member
        <a href="#" onClick="update_post();" class="btn btn-primary">投稿する</a>
        -->
    </div>

    <hr />
    <br />
    <div class="panel-footer">
        {{ link_to_route('chats.index', '戻る') }}
    </div>
</div>

<!-- -->
<script>
firebase.initializeApp({
    'messagingSenderId': AppConst.messagingSenderId
});
//FCM
const CHAT_MEMBER_ID  ="{{$chat_member->id}}";
const CHAT_ID  ="{{$id}}";
const USER_ID  ="{{$user_id}}";
const messaging = firebase.messaging();
messaging.usePublicVapidKey(AppConst.PublicVapidKey );
var IID_TOKEN ="";
const FCM_SERVER_KEY = AppConst.FCM_SERVER_KEY ;
const textInstanceIdToken = document.getElementById('textInstanceIdToken');
const elem_title = document.getElementById('send_title');
const elem_body = document.getElementById('send_body');
//
var CHAT_MEMBERS = [];
@foreach ($chat_members as $item )
    var data = {
            'user_id': {{$item->user_id}},
            'token': "{{$item->token}}",
        };
    CHAT_MEMBERS.push(data);
@endforeach
//
var botui = new BotUI('botui-app') // id of container
new Vue({
        el: '#app',
    data: {
        message: '',
    },
    created:function(){
        this.get_posts(USER_ID);
    },
    methods: {
        update() {
            this.message = 'Vue.js';
        },
        get_posts(USER_ID) {
            axios.get('/api/apichats/get_post?cid=' +CHAT_ID)
            .then(res =>  {
                var items = res.data;
                items.forEach(function(item){
//console.log(item.user_id )
                    if(item.user_id == USER_ID){
                        botui.message.add({
                            human: true,
                            content: item.body
                        });                        
                    }else{
                        botui.message.add({ content: item.body });
                    }
                });
            })            
        },
        addItem() {
            console.log(this.message );
            update_post(this.message );
            botui.message.add({
                human: true,
                content: this.message
            });
            this.message='';
        },
    }
});
//    console.log(CHAT_MEMBERS);
    /**********************************************
     *
     *********************************************/
    function fcm_send_proc(){
        fcm_send(elem_title.value, elem_body.value, IID_TOKEN, FCM_SERVER_KEY);
    }
    // 
    function update_post(body){
        var data = {
                'chat_id': CHAT_ID,
                'user_id': USER_ID,
                'body': body,
            };
            axios.post('/api/apichats/update_post' , data ).then(res => {
 console.log(res.data );
                fcm_send_member(body );
            });
    }
    // 
    function fcm_send_member(body){
        CHAT_MEMBERS.forEach(function(item){
//            console.log(item.token )
            fcm_send(CHAT_ID, body, item.token, FCM_SERVER_KEY);
        });
    }
    /**********************************************
     * GET token
     *********************************************/    
    messaging.getToken().then((currentToken) => {
        if (currentToken) {
            sendTokenToServer(currentToken);
            IID_TOKEN = currentToken;
            textInstanceIdToken.value = IID_TOKEN;
            send_token(IID_TOKEN);
            console.log(currentToken);
        } else {
            // Show permission request.
            alert("ブラウザ通知を許可に設定下さい。メッセージを送受信できません");
            console.log('No Instance ID token available. Request permission to generate one.');
            // Show permission UI.
            updateUIForPushPermissionRequired();
            setTokenSentToServer(false);
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        setTokenSentToServer(false);
    });
    /**********************************************
     * recv
     *********************************************/    
    messaging.onMessage((payload) => {
//        console.log('Message received. ', payload);
        var notify = payload.notification;
//        recv_pushMessage(notify.title, notify.body);
        recv_pushMessage("", notify.body);
        botui.message.add({
//                human: true,
                content: notify.body
        });        
//        console.log(notify.title );
        console.log(notify.body );
    });
    /**********************************************
     *
     *********************************************/    
     function send_token(token) {
        var data = {
                'chat_member_id': CHAT_MEMBER_ID,
                'token': token,
            };
            axios.post('/api/apichats/update_token' , data ).then(res => {
// console.log(res.data );
            });
     }
    //
    function sendTokenToServer(currentToken) {
        if (!isTokenSentToServer()) {
            console.log('Sending token to server...');
            // TODO(developer): Send the current token to your server.
            setTokenSentToServer(true);
        } else {
            console.log('Token already sent to server so won\'t send it again ' +
            'unless it changes');
        }
    }
    //
    function isTokenSentToServer() {
        return window.localStorage.getItem('sentToServer') === '1';
    }
    //
    function setTokenSentToServer(sent) {
        window.localStorage.setItem('sentToServer', sent ? '1' : '0');
    }
</script>
<!-- -->
<style>
#send_button{
    /*      */
    margin : 30px 10px;
}
#send_text{
    margin : 20px 0px;
}
</style>

@endsection
