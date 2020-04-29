@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="mt-2">タスク一覧 </h3>
        <!--  -->
        <BR />
        {{ link_to_route('tasks.create', 'Create' ,null, ['class' => 'btn btn-primary mb-2']) }}
        <BR />
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>タスク名</th>
                <!--
                <th>完了</th>
                -->
                <th>編集</th>
                <th>削除</th>
            </thead>
            <?php //debug_dump($tasks); ?>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="table-text">
                            {{ link_to_route('tasks.show', $task->title, $task->id) }}
                        </td>
                        <td class="table-text">
                            {{ link_to_route('tasks.edit', '編集'
                            , $task->id, ['class' => 'btn btn-sm btn btn-outline-primary']) }}
                        </td>
                        <td class="table-text">
                            {{ Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) }}
                                {{ Form::hidden('id', $task->id) }}
                                {{ Form::submit('削除', ['class' => 'btn btn-sm btn btn-outline-primary']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br />
        <!-- paginater -->
        {{ $tasks->links() }}

        <br />
        <hr />
        <br />
        @include('element.page_info',
        [
            'git_url' => 'https://github.com/kuc-arc-f/lara58a',
            'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_1'
        ])        

    </div>

</div>

@endsection

