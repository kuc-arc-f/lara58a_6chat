
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
    <div class="panel panel-default">
        <br />
        <div class="panel-heading">
            {{ link_to_route('chats.index', '戻る'  ,null, ['class' => 'btn btn-outline-primary'] ) }}
            <br />
            <br />
            <h3>chat - 新規作成</h3>
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
            {!! Form::model($chat, [
                'route' => 'chats.store', 'method' => 'post', 'class' => 'form-horizontal'
            ]) !!}
            <div class="form-group">
                {!! Form::label('name', 'name :', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', $chat->name, [
                         'class' => 'form-control' ,'required'=>'required' ]) 
                    !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('content', '説明 :', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('content', $chat->content, [
                        'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::submit('追加する', ['class' => 'btn btn-primary']) !!}
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
