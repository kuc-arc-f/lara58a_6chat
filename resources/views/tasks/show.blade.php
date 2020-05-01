@extends('layouts.app')

@section('title', $task->name)

@section('content')

    <div class="panel panel-default">
        <br />
        {{ link_to_route('tasks.index', '戻る', null, ['class' => 'btn btn-outline-primary'] ) }}
        <div class="panel-heading">
            <!-- class="mt-10"
            -->
            <br />     
            <h3 >{{ $task->title }} </h3>
            <hr />
        </div>
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('name', 'Name :', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <pre class="pre_text">{{ $task->title }}</pre>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('content', 'Content :', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <pre class="pre_text">{{ $task->content }}</pre>
                </div>
            </div>
            <!--
            <div>タスク名: {{ $task->title }}
            </div>
            <div>content : {{ $task->content }}
            </div>                
            -->
        </div>
        <div class="panel-footer">
        </div>
    </div>
<!-- -->
<style>
.panel-body .pre_text{
	border: 1px solid #000;
	background: #EEE;
	padding : 10px;
}    
</style>
@endsection
