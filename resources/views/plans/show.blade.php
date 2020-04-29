@extends('layouts.app')
@section('title', "")

@section('content')

<div class="panel panel-default">
    <br />
    <div class="panel-heading">
        {{ link_to_route('plans.index', '戻る', null, ['class' => 'btn btn-outline-primary'] ) }}
        <br />
        <br />
        <h3>{{ $plan->date }}</h3>
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
        <!--
        <br />
        {{ link_to_route('plans.index', '戻る') }}            
        -->

    </div>
</div>

@endsection
