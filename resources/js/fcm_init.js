

/**********************************************
 * Send POST
 *********************************************/    
function fcm_send(send_title, send_body, IID_TOKEN, FCM_SERVER_KEY){

    if(IID_TOKEN.length < 1){ return; }
    var key = FCM_SERVER_KEY;
    var to = IID_TOKEN;
    var notification = {
        'title': send_title,
        'body': send_body,
        'icon': 'firebase-logo.png',
        'click_action': 'http://localhost'
    };

    fetch('https://fcm.googleapis.com/fcm/send', {
    'method': 'POST',
    'headers': {
        'Authorization': 'key=' + key,
        'Content-Type': 'application/json'
    },
    'body': JSON.stringify({
        'notification': notification,
        'to': to
        })
    }).then(function(response) {
//        console.log(response);
    }).catch(function(error) {
        console.error(error);
    })
};


var data = { 'param1': 1 };
axios.post('/api/apisystem/get_fcm_init' , data ).then(res => {
//console.log(res.data );
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
    fcm_get_token();
    fcm_onMessage();
}
/**********************************************
 * Notification 通知
 *********************************************/    
function recv_pushMessage(title, body){
    if (!('Notification' in window)) {//対応してない場合
        alert('未対応のブラウザです');
    }
    else {
        // 許可を求める
        Notification.requestPermission()
        .then((permission) => {
            if (permission === 'granted') {// 許可
                var options ={
                    body: body,
//                    icon: 'http://localhost:8000/icon1.png',
                    icon: 'https://knaka0209.net//icon1.png',                    
                    tag: ''
                };
                var n = new Notification(title,options);
                console.log(n);
                setTimeout(n.close.bind(n), 5000);
            }
            else if (permission == 'denied') {// 拒否
            }
            else if (permission == 'default') {// 無視
            }
        });
    }  
}  
