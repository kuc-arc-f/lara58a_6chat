@extends('layouts.app')

@section('title', "編集")

@section('content')
    <div class="panel panel-default">
        <br />
        <div class="panel-heading">
           {{ link_to_route('todos.index', '戻る' ,null, ['class' => 'btn btn-outline-primary']) }}
           <br />
           <br />
           <h3>編集</h3>
        </div>
        <hr />
        <div class="panel-body">
            {!! Form::model($todo, ['route' => ['todos.update', $todo->id], 'method' => 'patch', 
            'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('title', $todo->title, [
                            'id' => 'todo-title', 'class' => 'form-control',
                            'required'=>'required'
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('content', $todo->content, [
                            'id' => 'todo-content', 'class' => 'form-control',
                            'rows' => 6,'cols' => 10
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('complete', 'complete', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        <!-- '' => '選択下さい', 
                            [
                             '0' => '未完了', '1' => '完了済'],
                        -->
                        {{ Form::select('complete',  $complete_items, 
                            null, 
                            ['class' => 'form-control', 'id' => 'complete', 'required'=>'required']
                        ) }}
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
        </div>
    </div>

@endsection
