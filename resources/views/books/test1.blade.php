@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <br />
        タスク一覧
    </div>
    <hr />
    <div class="panel-body">
        <form method="POST" action="/books/test2" >
            @csrf
            {{ Form::hidden('delete_id', 0, ["id" => "delete_id"]) }}
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! Form::submit('タスク追加', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<hr />
<div>

@endsection
