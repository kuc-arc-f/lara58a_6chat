@extends('layouts.app')
@section('title', "")

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <br />
        <h1>{{ $plan->date }}</h1>
    </div>
    <hr />
    <div class="panel-body">
        <!-- 
        <div class="form-group">
            {!! Form::label('date', '日付:', ['class' => 'col-sm-3 control-label']) !!}
            {{ $plan->date }}
        </div>
        -->
        <div class="form-group">
            {!! Form::label('content', '内容:', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <?php
                $content = nl2br($plan->content);
                echo($content);
                ?>
            </div>
        </div>        
    </div>
    <hr />
    <div class="panel-footer">
        <br />
        {{ link_to_route('plans.index', '戻る') }}
    </div>
</div>

@endsection
