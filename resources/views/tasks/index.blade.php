@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default" style="margin-top: 16px;">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-6"><h3>Tasks - index</h3>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                {{ link_to_route('tasks.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
            </div>
        </div>
        <!--
        <h3 class="mt-2">タスク一覧 </h3>
        <BR />
        {{ link_to_route('tasks.create', 'Create' ,null, ['class' => 'btn btn-primary mb-2']) }}
        <BR />
        -->
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Open</th>
                <th>Action</th>
            </thead>
            <?php //debug_dump($tasks); ?>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="table-text">
                            <?= $task->id ?>
                        </td>
                        <td class="table-text">
                            <p class="p_tbl_task_name mb-0">
                                {{ link_to_route('tasks.show', $task->title, $task->id) }}
                            </p>
                        </td>
                        <td class="table-text">
                            <a href="/tasks/<?= $task->id ?>"><i class="fas fa-external-link-alt"></i>
                            </a>                            
                        </td>
                        <td class="table-text">
                            <div style="float :left; margin-right :10px">
                                <a href="/tasks/<?= $task->id ?>/edit"
                                    class="a_edit_link" 
                                    data-toggle="tooltip" title="編集します">
                                    <i class="far fa-edit"></i>
                                </a>
                                <!--
                                {{ link_to_route('tasks.edit', '編集'
                                , $task->id, ['class' => 'btn btn-sm btn btn-outline-primary']) }}                                    
                                -->
                            </div>
                            {{ Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) }}
                                {{ Form::hidden('id', $task->id) }}
                                {{ Form::submit('削除', ['class' => 'btn btn-sm btn-outline-danger']) }}
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
<!-- -->
<style>
.p_tbl_task_name{ font-size: 1.2rem; }
.task-table td{ padding : 8px;}
/* .task-table .a_edit_link{ font-size : 1.2rem; } */
.task-table  td i {font-size : 1.2rem; }
</style>

@endsection

