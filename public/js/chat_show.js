
/**********************************************
 *
 *********************************************/    
function send_token(token, CHAT_MEMBER_ID) {
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
/**********************************************
 * GET token
 *********************************************/    
function fcm_get_token( CHAT_MEMBER_ID ){
	messaging.getToken().then((currentToken) => {
		if (currentToken) {
			sendTokenToServer(currentToken);
			IID_TOKEN = currentToken;
			textInstanceIdToken.value = IID_TOKEN;
			send_token(IID_TOKEN, CHAT_MEMBER_ID);
//                console.log(currentToken);
		} else {
			alert("ブラウザ通知を許可に設定下さい。メッセージを送受信できません");
			console.log('No Instance ID token available. Request permission to generate one.');
			updateUIForPushPermissionRequired();
			setTokenSentToServer(false);
		}
	}).catch((err) => {
		console.log('An error occurred while retrieving token. ', err);
		setTokenSentToServer(false);
	});
}
/**********************************************
 *
 *********************************************/    
function get_receiveUserId( title ){
	console.log("#get_receiveUserId: " + title);
}
