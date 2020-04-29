
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
<div class="panel panel-default">
    <br />
    <div class="panel-heading">
        {{ link_to_route('plans.index', '戻る',null, ['class' => 'btn btn-outline-primary'] ) }}
        <br />
        <br />
        <h3>新規作成</h3>
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
        {!! Form::model($plan, [
            'route' => 'plans.store', 'method' => 'post', 'class' => 'form-horizontal'
        ]) !!}
        <div class="form-group">
            <?php
            $class_title = "form-control";
            if(!empty(($errors->first('title')))){ $class_title = $class_title ." is-invalid"; }
            ?>
        </div>
        <!--date -->
        <div class="form-group">
            {!! Form::label('date', '日付', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
                <input type="date" name="date" class="form-control"
                value="{{$plan->date}}" required="required" />
            </div>
        </div>            
        <div class="form-group">
            {!! Form::label('content', '内容:', ['class' => 'col-sm-3 control-label']) !!}
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
                {!! Form::submit('予定追加', ['class' => 'btn btn-primary']) !!}
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
