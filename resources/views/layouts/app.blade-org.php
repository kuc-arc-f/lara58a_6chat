<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Demo</title>
	<!-- Styles -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<!-- js -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="/js/marked.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-35920247-13"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-35920247-13');
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="/">Demo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav  mr-auto">
				<!--
				<li class="nav-item active">
					<a class="nav-link" href="/">Home</a>
				</li>
				-->
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
					id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">develop</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="/tasks">Task</a>
						<a class="dropdown-item" href="/mdats">mDats</a>
						<a class="dropdown-item" href="/books">Book</a>
						<a class="dropdown-item" href="/depts">Depts</a>
						<a class="dropdown-item" href="/members">Members</a>
						<!--
							横仕切り線
						<div class="dropdown-divider"></div>
						-->
					</div><!-- ./dropdown-menu -->
				</li>                
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
					id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">Vue</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="/vue_tasks">VueTasks</a>
						<a class="dropdown-item" href="/vue_todos">VueTodos</a>
						<a class="dropdown-item" href="/vue_books">VueBooks</a>
						<a class="dropdown-item" href="/vue_sort_items">VueSortItems</a>
					</div><!-- ./dropdown-menu -->
				</li>                

				<li class="nav-item active">
					<a class="nav-link" href="/chats">Chats</a>
				</li>                  
				<li class="nav-item active">
					<a class="nav-link" href="/todos">Todos</a>
				</li>  
				<li class="nav-item active">
					<a class="nav-link" href="/plans">Plans</a>
				</li>                              
			</ul>
			<!-- right_nav -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<?php if (isset($user->name)){ ?>  
						<p style="margin: 10px; color: gray;">User : {{$user->name}}</p>
					<?php } ?>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/about">About</a>
				</li>
				<li class="nav-item active">
						{!! Form::model(null, [
							'route' => 'logout', 'method' => 'post', 'class' => 'form-horizontal'
						]) !!}
						{!! Form::submit('logout', ['class' => 'btn btn-default']) !!}
						{!! Form::close() !!}
				</li>                
			</ul>            
		</div>
		<hr />
	</nav>    
	<!-- flash -->
	@if (session('flash_message'))
	<div class="flash_message bg-success text-center py-3 my-0" id="flash_message">
		{{ session('flash_message') }}
	</div>
	@endif    
	<!-- main_content  -->
	<div class="container">
		@yield('content')
	</div>
	<!-- footer -->
	@include('footer', [])        
</body>
</html>
<!-- -->
<style>
#flash_message{ color : white; }
</style>
