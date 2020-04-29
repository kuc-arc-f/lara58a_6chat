@extends('layouts.app')

@section('title', "show")

@section('content')
<div id="app">
	<div class="panel panel-default">
		<br />
		<h1>Show :</h1>
		<hr />
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<div>
				<h3>@{{this.title}} </h3>
			</div>
			<hr />
			<div>
				<!--  -->
				content :<br /><br />
				<div id="content_wrap">
					<div v-html="content"></div>
				</div>
			</div>  
			<hr />
			<div>
				complete: {{ $complete_str }}
			</div>   
		</div>
		<hr />
		<br />

		<div class="panel-footer">
			{{ link_to_route('vue_todos.index', '戻る', null, ["class" => "btn btn-outline-primary" ] ) }}
		</div>
	</div>
</div>
<!-- -->
<script>
new Vue({
	el: '#app',
	created () {
	},  
	mounted: function() {
		this.getItem();
	},      
	data: {
		item: null,
		title: '',
		content  : '',
	},
	methods: {
		getItem: function() {
			var task = {
				"id" : {{$task_id}},
			};
			axios.post('/api/apitodos/get_item' ,task).then(res => {
				this.item = res.data;
				this.title = this.item.title;
				this.content = this.item.content;
				this.content= marked(this.content);
console.log(this.item  );                
console.log(res.data.id );
//                window.location.href = '/tasks';
			});
		}        
	}
});
//
$(function() {
	//MD_convert
//    var content = $("#content-hidden").val();
//    content= marked(content);
//    console.log(content);
//    $("#content_wrap").append(content);
});
</script>
	
@endsection

