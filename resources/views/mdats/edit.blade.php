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
        {!! Form::model($mdat, ['route' => ['mdats.update', $mdat->id], 'method' => 'patch', 
        'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('date', '日付', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
                <input type="date" name="date" class="form-control"
                value="{{$mdat->date}}" required="required" />
            </div>                
        </div>
        <div class="form-group">
            {!! Form::label('hnum', 'Hight :', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('hnum', $mdat->hnum, [
                    'id' => 'mdat-title', 'class' => "form-control" ,'required'=>'required' ]) 
                !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lnum', 'Low :', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('lnum', $mdat->lnum, [
                    'id' => 'mdat-lnum', 'class' => "form-control" ,'required'=>'required' ]) 
                !!}
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
        {{ link_to_route('mdats.index', '戻る', null, ['class' => 'btn btn-outline-primary'] ) }}
    </div>
</div>

@endsection
