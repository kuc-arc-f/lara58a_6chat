
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
        {!! Form::model($book, [
            'route' => 'books.store', 'method' => 'post', 'class' => 'form-horizontal'
        ]) !!}
        <div class="form-group">
            {!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('title', $book->title, [
                    'id' => 'book-title', 'class' => "form-control"  ,'required'=>'required' ]) 
                !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('content', $book->content, [
                    'id' => 'book-content', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('type', 'type', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {{ Form::select('type', [
                    '' => '選択下さい', '1' => 'type-A', '2' => 'type-B'], 
                    null, 
                    ['class' => 'form-control', 'id' => 'type', 'required'=>'required']
                ) }}
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
        {{ link_to_route('books.index', '戻る') }}
    </div>
</div>
@endsection
