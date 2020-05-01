@extends('layouts.app')

@section('title', ' ')

@section('content')
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>

<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<h1>Google 認証:</h1>
			<hr />
			<p>・ ポップアップ画面で、Googleログイン認証ログインしてください。</p>
			<p>・ chromeブラウザのポップアップ許可が必要になります。</p>
			<p>・ chromeブラウザに、Googleアカウントでログインしている事が必用となります。</p>
		</div>
	</div>
</div>
<!-- form_next -->
<div clas="form_next_wrap" style="display: none;">
{!! Form::model(null, [
	'route' => 'login', 'method' => 'post', 'class' => 'form-horizontal','id'=>'form_next'
]) !!}
	{!! Form::text('email', null, [
		'id' => 'email', 'class' => "form-control"  ]) 
	!!}
	<div class="form-group row">
		{!! Form::text('password', null, [
			'id' => 'password', 'class' => "form-control"  ]) 
		!!}
	</div>
	<div class="form-group row">
		<input class="form-check-input" type="checkbox" name="remember" id="remember" checked="checked" >
	</div>
{!! Form::close() !!}
</div>

<!-- -->
<script>
function next_auth_send(mail){
	$("#email").val(mail);
	$('#form_next').submit();
}
function popup_open( provider ){
	firebase.auth().signInWithPopup( provider).then(function(result) {
		var token = result.credential.accessToken;
		var user = result.user;
		this.user = result.user;
		//console.log(user.uid)
		console.log(user.email)
		//console.log(user.displayName)
		var user = {
			"email" : user.email,
			"displayName" : user.displayName,
			"uid" : user.uid,
		};
		axios.post('/users/get_user' , user).then(res => {
			var data = res.data;
//console.log(data);
console.log(data.return  );              
			if(data.return == 1){
console.log(data.user);
				next_auth_send( data.user.email );
			}else{
				alert("このメールは。通常メールログインで登録済で。Googleログインできません");
			}
		});				
	}).catch(function(error) {
		var errorCode = error.code;
		var errorMessage = error.message;
		console.log(errorCode)
		console.log(errorMessage)
	});	
}
// init_firebase
var firebaseConfig = {
	apiKey: "",
	authDomain: "",
	projectId: "",
	appId: ""
};
//init
var AppConst = {
	"auth_pass" : "",
}
var data = { 
	'param1': 1, 
	'mail': '<?= $SUPER_USER_MAIL ?>', 
	'password': 'password' 
};
axios.post('/api/apisystem/get_google_auth' , data ).then(res => {
	var resParams = res.data.params;
	var params ={
		"apiKey" : resParams.apiKey,
		"authDomain" : resParams.authDomain,
		"projectId" : resParams.projectId,
		"appId" : resParams.appId,		
	};
	var auth_pass = resParams.auth_pass;
	$("#password").val( auth_pass );
	firebaseConfig = params;
// console.log( firebaseConfig );
	firebase.initializeApp(firebaseConfig);
	var provider = new firebase.auth.GoogleAuthProvider();
	popup_open( provider );
});
</script>

@endsection
