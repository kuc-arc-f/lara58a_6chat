@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <BR />
        <h1>Todos - index</h1>
        <BR />
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>ID</th>
                <th>タスク名</th>
                <!--
                <th>完了</th>
                -->
                <th>編集</th>
                <th>削除</th>
            </thead>
            <?php //debug_dump($tasks); ?>
            <tbody>
                @foreach ($todos as $todo)
                    <tr>
                        <td class="table-text">{{ $todo->id }}
                        </td>
                        <td class="table-text">
                            {{ link_to_route('todos.show', $todo->title, $todo->id) }}
                        </td>
                        <td class="table-text">
                            {{ link_to_route('todos.edit', '編集'
                            , $todo->id, ['class' => 'btn btn-sm btn-default']) }}
                        </td>
                        <td class="table-text">
                            {{ Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'delete']) }}
                                {{ Form::hidden('id', $todo->id) }}
                                {{ Form::submit('削除', ['class' => 'btn btn-sm btn-default']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br />

        <br />
        <hr />
        {{ link_to_route('todos.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
        <br />
        <br />
    </div>
</div>

@endsection
