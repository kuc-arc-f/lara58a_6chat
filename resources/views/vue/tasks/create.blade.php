
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
<div id="app">
    新規作成
    {!! Form::model($task, [
        'route' => 'tasks.store', 'method' => 'post', 'class' => 'form-horizontal'
    ]) !!}
    {!! Form::close() !!}   
    <div class="form-group">
        {!! Form::label('title', 'タスク名', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <input type="text" class="form-control" id="title" v-model="title">
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <input type="text" class="form-control" id="content" v-model="content">
        </div>
    </div>    

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button class="btn btn-outline-primary" v-on:click="send_post">投稿
            </button>                    
        </div>
    </div>
</div>
<!-- -->
<script>
var token = $('input[name="_token"]').val();
console.log( token );
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
            var token = $('input[name="_token"]').val();
console.log( token );
            var task = {
                'title': this.title,
                'content': this.content,
                'csrf-token' : token
            };
            axios.post('/api/apitasks/create_task' , task ).then(res => {
                console.log(res.data );
                window.location.href = '/vue_tasks';
            });
        },        
    }

});
</script>
@endsection
