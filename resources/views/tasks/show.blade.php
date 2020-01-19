@extends('layouts.app')

@section('title', $task->name)

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $task->title }}
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
            {{ link_to_route('tasks.index', '戻る') }}
        </div>
    </div>

@endsection
