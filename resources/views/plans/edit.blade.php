@extends('layouts.app')
@section('title', "編集")

@section('content')

<div class="panel panel-default">
    <br />
    <div class="panel-heading">
        {{ link_to_route('plans.index', '戻る',  null, ['class' => 'btn btn-outline-primary']  ) }}
        <br />
        <br />
        <h3>編集</h3>
    </div>
    <hr />
    <div class="panel-body">
        {!! Form::model($plan, ['route' => ['plans.update', $plan->id], 'method' => 'patch', 
        'class' => 'form-horizontal']) !!}
            <!--date -->
            <div class="form-group">
                {!! Form::label('date', '日付: ', ['class' => 'col-sm-3 control-label']) !!}
                {{$plan->date}}
                <div class="col-sm-6">
                    {!! Form::hidden('date', $plan->date, [
                        'required'=>'required' ]) 
                    !!}
                    </div>                        
                </div>                    
            </div>            
            <div class="form-group">
                {!! Form::label('content', '内容', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('content', $plan->content, [
                        'id' => 'todo-content', 'class' => 'form-control',
                        'rows' => 6,'cols' => 10,
                        'required'=>'required'
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
    <div class="delete_wrap">
    {{ Form::open(['route' => ['plans.destroy', $plan->id], 'method' => 'delete']) }}
        {{ Form::hidden('id', $plan->id) }}
        {{ Form::submit('削除', ['class' => 'btn btn btn-danger']) }}
    {{ Form::close() }}        
    </div>
    <hr />
    <br />
    <div class="panel-footer">
    </div>
</div>

@endsection
