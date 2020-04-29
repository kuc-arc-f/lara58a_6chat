
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
<div id="app">
    <div class="panel panel-default">
        <br />
        <div class="panel-heading">
            <h1>新規作成</h1>
        </div>
        <hr />
		@if (count($errors) > 0)
			<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
			    <li>{{ $error }}</li>
			@endforeach
			</ul>
			</div>
		@endif
        <div class="panel-body">
            {!! Form::model($todo, [
                'route' => 'todos.store', 'method' => 'post', 'class' => 'form-horizontal'
            ]) !!}
            {!! Form::close() !!}
            <div class="form-group">
                {!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="title" v-model="title">
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <textarea id="todo-content" class="form-control" rows="6" cols="10"
                    v-model="content" name="content"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button class="btn btn-outline-primary" v-on:click="send_post">投稿
                    </button>                    
                </div>
            </div>
        </div>
        <hr />
        <br />
        <div class="panel-footer">
            {{ link_to_route('vue_todos.index', '戻る' ,null, ["class" => "btn btn-outline-primary" ] ) }}
        </div>
    </div>
</div>
<!-- -->
<script>
//
new Vue({
    el: '#app',
    created () {
    },    
    data: {
        title :'',
        content: '',
    },
    methods: {
        send_post(){
            var task = {
                'title': this.title,
                'content': this.content,
            };
            axios.post('/api/apitodos/create_todo' , task ).then(res => {
                console.log(res.data );
                window.location.href = '/vue_todos';
            });
        },        
    }

});
</script>    
@endsection
