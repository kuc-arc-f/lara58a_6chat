@extends('layouts.app')

@section('title', "$task->nameの編集")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $task->name }}の編集
        </div>
        <div class="panel-body">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'タスク名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', $task->name, ['id' => 'task-name', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('done', '完了', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('done', [false => '未', true => '完了'], $task->done, ['id' => 'task-done', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        {!! Form::button('<i class="fa fa-save"></i> 保存', ['type' => 'submit', 'class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            {{ link_to_route('tasks.index', '戻る') }}
        </div>
    </div>

@endsection
