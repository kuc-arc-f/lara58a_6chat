@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>

<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading">
			Users -test
		</div>
		<div class="panel-body">
			<h1>test -Google Login:</h1>
			<hr />
			<p>・ ポップアップ画面で、Googleログイン認証ログインしてください。</p>
			<p>・ chromeブラウザのポップアップ許可が必要になります。</p>
			<p>・ chromeブラウザに、Googleアカウントでログインしている事が必用です。</p>
		</div>
	</div>
</div>
<!-- -->
<script>
// Your web app's Firebase configuration
var firebaseConfig = {
	apiKey: "AIzaSyCEWHm9n33ayZ-_ktBFW_nE6Bis01_nXEA",
	authDomain: "spa1-project.firebaseapp.com",
	databaseURL: "https://spa1-project.firebaseio.com",
	projectId: "spa1-project",
	storageBucket: "spa1-project.appspot.com",
	messagingSenderId: "597018011814",
	appId: "1:597018011814:web:68e880a7483462f9512c67"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

//vue
new Vue({
	el: '#app',
	data: {
		message: '',
	},
	created:function(){
//console.log("create");
		this.provider = new firebase.auth.GoogleAuthProvider();
        this.popup_open();
	},
	methods: {
		update() {
			this.message = '';
		},
		popup_open: function(){
			firebase.auth().signInWithPopup(this.provider).then(function(result) {
				var token = result.credential.accessToken;
				console.log(token)
				var user = result.user;
				console.log(user.uid)
				console.log(user.email)
				console.log(user.displayName)
			}).catch(function(error) {
				var errorCode = error.code;
				var errorMessage = error.message;
				console.log(errorCode)
				console.log(errorMessage)
			});			
		}
	}
});

</script>

@endsection
