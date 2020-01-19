@extends('layouts.app')

@section('title', "$task->nameの編集")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
           <br />
           <h1>編集</h1>
        </div>
        <hr />
        <div class="panel-body">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'patch', 
            'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('title', $task->title, [
                            'id' => 'task-title', 'class' => 'form-control'
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('content', $task->content, [
                            'id' => 'task-content', 'class' => 'form-control'
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        {!! Form::button('<i class="fa fa-save"></i> 保存', 
                        ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <hr />
        <br />
        <div class="panel-footer">
            {{ link_to_route('tasks.index', '戻る') }}
        </div>
    </div>

@endsection
