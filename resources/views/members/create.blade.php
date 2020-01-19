
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
<div class="panel panel-default">
    <br />
    <div class="panel-heading">
        <h1>Member/新規作成</h1>
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
        {!! Form::model($member, [
            'route' => 'members.store', 'method' => 'post', 'class' => 'form-horizontal'
        ]) !!}
        <div class="form-group">
            {!! Form::label('name', 'name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', $member->name, [
                    'id' => 'member-name', 'class' => "form-control"  ,'required'=>'required' ]) 
                !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('dept_id', 'dept_id', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('dept_id', $member->depts_id, [
                    'id' => 'member-dept_id', 'class' => "form-control"  ,'required'=>'required' ]) 
                !!}
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
        {{ link_to_route('members.index', '戻る') }}
    </div>
</div>
@endsection
