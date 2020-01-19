
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
        <!--date -->
        <div class="form-group">
            {!! Form::label('date_1', '日付_1', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
                <!--
                {{Form::selectYear('date_1[year]', 2013, 2015, 2014, ['class' => 'form-control'])}}
                {{Form::selectMonth('date_1[month]', 0, ['class' => 'form-control'])}}
                {{Form::selectRange('date_1[day]', 1, 30, 0, 
                [ 'id'=> 'date_1_day' ,'class' => 'form-control'])}}
                -->
                <input type="date" name="date_1" class="form-control"
                value="{{$book->date_1}}"  />
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('radio_1', 'radio_1', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
                {{Form::radio('radio_1', 1 ,true)}} R1<br />
                {{Form::radio('radio_1', 2)}} R2           
            </div>
        </div>    
        <div class="form-group">
            {!! Form::label('check_1', 'check_1', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
                {{Form::checkbox('check_1', 1, true)}} CH_1  <br />
                {{Form::checkbox('check_2', 1, true)}} CH_2
            </div>
        </div>   

        <br />
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
