@extends('layouts.app')

@section('title', "編集")

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <br />
        <h1>編集</h1>
    </div>
    <hr />
    <div class="panel-body">
        {!! Form::model($book, ['route' => ['books.update', $book->id], 'method' => 'patch', 
        'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('title', 'title', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', $book->title, [
                        'id' => 'book-title', 'class' => 'form-control'
                    ]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('content', 'content', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('content', $book->content, [
                        'id' => 'book-content', 'class' => 'form-control'
                    ]) !!}
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
            <!--date -->
            <div class="form-group">
                {!! Form::label('date_1', '日付_1', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-4">
                    <input type="date" name="date_1" class="form-control"
                    value="{{$book->date_1}}"  />
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('radio_1', 'radio_1', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-4">
                    {{Form::radio('radio_1', 1)}} R1<br />
                    {{Form::radio('radio_1', 2)}} R2           
                </div>
            </div>    
            <div class="form-group">
                {!! Form::label('check_1', 'check_1', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-4">
                    {{Form::checkbox('check_1', 1 )}} CH_1  <br />
                    {{Form::checkbox('check_2', 1 )}} CH_2  <br />
                </div>
            </div>            
            <!-- -->
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
