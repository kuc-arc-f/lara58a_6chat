@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        タスク一覧
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>タスク名</th>
                <th>完了</th>
                <th>編集</th>
                <th>削除</th>
            </thead>
            <?php //debug_dump($tasks); ?>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="table-text">
                            {{ link_to_route('tasks.show', $task->name, $task->id) }}
                        </td>
                        <td class="table-text">
                            {{ $task->done ? '完了' : '未' }}
                        </td>
                        <td class="table-text">
                            {{ link_to_route('tasks.edit', '編集'
                            , $task->id, ['class' => 'btn btn-sm btn-default']) }}
                        </td>
                        <td class="table-text">
                            {{ Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) }}
                                {{ Form::hidden('id', $task->id) }}
                                {{ Form::submit('削除', ['class' => 'btn btn-sm btn-default']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br />
        new:<br />
        {{ link_to_route('tasks.create', '[ create ]' ) }}
        <br />
        <br />
        <a href="make/"  class="btn btn-primary ">詳細はこちら </a>
    </div>
</div>

@endsection
