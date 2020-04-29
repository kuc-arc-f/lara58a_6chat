@extends('layouts.app')

@section('title', $task->name)

@section('content')

    <div class="panel panel-default">
        <br />
        <div class="panel-heading">
            {{ link_to_route('tasks.index', '戻る', null, ['class' => 'btn btn-outline-primary'] ) }}
            <br />       
            <br />     
            <h3>{{ $task->title }} </h3>
            <hr />
        </div>
        <div class="panel-body">
            <div>
                タスク名: {{ $task->title }}
            </div>
            <div>
                content : {{ $task->content }}
            </div>            

        </div>
        <div class="panel-footer">
        </div>
    </div>

@endsection
