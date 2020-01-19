
@extends('layouts.app')

@section('title', '新規作成')

@section('content')
<div class="panel panel-default">
    <br />
    <div class="panel-heading">
        <h1>Dept /新規作成</h1>
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
        {!! Form::model($dept, [
            'route' => 'depts.store', 'method' => 'post', 'class' => 'form-horizontal'
        ]) !!}
        <div class="form-group">
            {!! Form::label('name', 'name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', $dept->name, [
                    'id' => 'member-name', 'class' => "form-control"  ,'required'=>'required' ]) 
                !!}
            </div>
        </div>
        <hr />
        <br />
        <div class="member_wrap">
        <?php for($i=1 ; $i <= 10; $i++){ 
            $member_name = "name-" . $i;
            ?>
            <div class="form-group">
                {!! Form::label($member_name, $member_name, ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text("member[{$i}]", null, [
                         'class' => "form-control"  ]) 
                    !!}                    

                </div>
            </div>
        <?php } ?>
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
        {{ link_to_route('depts.index', '戻る') }}
    </div>
</div>
@endsection
