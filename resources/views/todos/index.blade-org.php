@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="row">
    <div class="col-sm-6"><h1>Todos - index</h1>
    </div>
    <div class="col-sm-6" style="text-align: right; font-size: 28px; padding-top:8px;">
        <a href="/" title="初心者用ヘルプ"><i class="fas fa-question-circle"></i></a>
    </div>

</div>
<div class="panel panel-default">
    <!-- 
    <div class="panel-heading">
        <BR />
        <h1>Todos - index</h1>  
    </div>
    -->
    <hr />
    {{ link_to_route('todos.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
    <hr />
    <br />
    <div class="complete_wrap">
        <a href="/todos?complete=0" class="btn btn-outline-primary">未完
        </a>
        <a href="/todos?complete=1" class="btn btn-outline-primary">完了 
        </a>
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>ID</th>
                <th>title</th>
                <th>edit</th>
                <th>delete</th>
            </thead>
            <tbody>
            @foreach ($todos as $todo)
            <tr>
                <td class="table-text">{{ $todo->id }}
                </td>
                <td class="table-text">
                    <h3>{{ link_to_route('todos.show', $todo->title, $todo->id) }}
                    </h3>
                    <?php if ($todo->complete == 1){ ?>
                        <h5> <span class="badge badge-secondary">完了済</span>
                        </h5>
                    <?php } ?>
                </td>
                <td class="table-text">{{ $todo->created_at }}
                </td>

                <td class="table-text">
                    {{ link_to_route('todos.edit', '編集'
                    , $todo->id, ['class' => 'btn btn-outline-primary']) }}
                </td>
                <td class="table-text">
                    {{ Form::open(['route' => ['todos.destroy', $todo->id], 
                    'method' => 'delete']) }}
                        {{ Form::hidden('id', $todo->id) }}
                        {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br />
        <br />
        @include('element.page_info',
        [
            'git_url' => 'https://github.com/kuc-arc-f/lara58a_3todo',
            'blog_url' => 'https://knaka0209.hatenablog.com/entry/lara58_6todo'
        ])        

    </div>
</div>

@endsection
