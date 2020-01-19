
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
    <div class="panel panel-default">
        <br />
        <div class="panel-heading">
            <h1>新規作成</h1>
        </div>
        <hr />
		@if (count($errors) > 0)
			<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
			    <li>{{ $error }}</li>
			@endforeach
			</ul>
			</div>
		@endif
        <div class="panel-body">
            {!! Form::model($todo, [
                'route' => 'todos.store', 'method' => 'post', 'class' => 'form-horizontal'
            ]) !!}
            <div class="form-group">
                {!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', $todo->title, [
                        'id' => 'task-title', 'class' => "form-control" ,'required'=>'required' ]) 
                    !!}
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
                <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::submit('タスク追加', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>


            {!! Form::close() !!}
        </div>
        <hr />
        <br />
        <div class="panel-footer">
            {{ link_to_route('todos.index', '戻る') }}
        </div>
    </div>
@endsection
