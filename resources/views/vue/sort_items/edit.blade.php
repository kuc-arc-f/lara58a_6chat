@extends('layouts.app')

@section('title', "編集")

@section('content')
<div id="app">
    <div class="panel panel-default">
        <div class="panel-heading">
           <br />
           <h1>編集</h1>
        </div>
        <hr />
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
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
                    <button class='btn btn-primary' v-on:click="postTask">投稿
                    </button>
                </div>
            </div>
            <hr />
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button class='btn' v-on:click="deleteTask">Delete
                    </button>
                </div>
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
var task_id= {{$task_id}};
//
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
            axios.post('/api/apitasks/get_item' ,task).then(res => {
                this.item = res.data;
                this.title = this.item.title;
                this.content = this.item.content;
console.log(this.item  );                
                console.log(res.data.id );
            });
        },
        postTask(){
            var task = {
                "id" : task_id,
                'title': this.title,
                'content': this.content
            };
            axios.post('/api/apitasks/update_post' ,task).then(res => {
                console.log(res.data.id );
                console.log(res.data.title);
                console.log(res.data.content);
            });
        }, 
        deleteTask(){
            var task = {
                "id" : task_id,
            };
            axios.post('/api/apitasks/delete_task' ,task).then(res => {
                console.log(res.data.id );
                window.location.href = '/tasks';
            });

        },
    }
});
</script>

@endsection
