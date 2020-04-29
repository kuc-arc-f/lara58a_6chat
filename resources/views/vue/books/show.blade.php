@extends('layouts.app')

@section('title', "")

@section('content')
<div id="app">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Show  :</h1>
		</div>
		<hr />
		<br />
		<div class="panel-body">
			<div>
				title: @{{ this.title }}
			</div>
			<div>
				content : @{{ this.content }}
			</div>            
			<div>
				date_1 :
			</div>   
			<div>
				radio_1 :
			</div>                    
			<div>
				check_1 :
			</div>
		</div>
		<hr />
		<br />
		<div class="panel-footer">
			{{ link_to_route('tasks.index', '戻る') }}
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
				"id" : {{$book_id}},
			};
			axios.post('/api/apibooks/get_item' ,task).then(res => {
				this.item = res.data;
				this.title = this.item.title;
				this.content = this.item.content;
console.log(this.item  );                
				console.log(res.data.id );
//                window.location.href = '/tasks';
			});
		}        
	}
});
</script>

@endsection
