@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 200px;">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					You are logged in!
				</div>
			</div>
		</div>
	</div>
	<!-- btn -->
	<div class="button_area_wrap mt-4" style="text-align: center;">
		<div class="form-group">
			<a href="/chats" class="btn btn-outline-primary" >Chats</a>
		</div>
		<div class="form-group">
			<a href="/plans" class="btn btn-outline-primary" >Plans</a>
		</div>
		<div class="form-group">
			<a href="/todos" class="btn btn-outline-primary" >Todos</a>
		</div>
		<!-- -->
		<div class="develop_box mt-0">
			<!-- -->
			<p><i class="far fa-arrow-alt-circle-right vuejs_btn"></i>Vue.js sample<br />
				<div class="vuejs_wrap" style="display: none;">
					<div class="form-group">
						<a href="/vue_tasks" class="btn btn-outline-primary" >VueTasks</a>
					</div>
					<div class="form-group">
						<a href="/vue_todos" class="btn btn-outline-primary" >VueTodos</a>
					</div>
					<div class="form-group">
						<a href="/vue_books" class="btn btn-outline-primary" >VueBooks</a>
					</div>
					<div class="form-group">
						<a href="/vue_sort_items" class="btn btn-outline-primary" >VueSortItems</a>
					</div>					
				</div>
			</p>
			<!-- -->
			<p><i class="far fa-arrow-alt-circle-right develop_btn"></i>develop<br />
				<div class="develop_wrap" style="display: none;">
					<div class="form-group">
						<a href="/tasks" class="btn btn-outline-primary" >Task</a>
					</div>
					<div class="form-group">
						<a href="/mdats" class="btn btn-outline-primary" >mDats</a>
					</div>
					<div class="form-group">
						<a href="/books" class="btn btn-outline-primary" >Book</a>
					</div>
					<div class="form-group">
						<a href="/depts" class="btn btn-outline-primary" >Depts</a>
					</div>
					<div class="form-group">
						<a href="/members" class="btn btn-outline-primary" >Members</a>
					</div>

				</div>
			</p>			
		</div>
	</div>
</div>
<!-- -->
<style>
.develop_box i{
	font-size: 1.4rem; 
	margin-right : 10px;
}
.develop_box p{
	 font-size: 1.2rem; 
}
/*
.footer_box{
	background-color: #FB8C00; 
	color:#FFF; 	
	padding : 20px 40px;
}
.footer_box p{
	margin-bottom: 10px; 
}
.footer_box a{
	color: inherit;
}
*/
</style>
<!-- -->
<script>
$(function(){
	$( '.develop_btn' ).click( function() {
		$('.develop_wrap').css('display','inherit');
	});
	$( '.vuejs_btn' ).click( function() {
		$('.vuejs_wrap').css('display','inherit');
	});
});
</script>
@endsection
