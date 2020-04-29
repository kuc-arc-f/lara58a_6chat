@extends('layouts.app')

@section('title', "")

@section('content')

    <div class="panel panel-default">
        <br />
        <div class="panel-heading">
           <h3>User edit</h3>
        </div>
        <hr />
        <div class="panel-body">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 
            'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'name :', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', $user->name, [
                            'id' => 'user-title', 'class' => 'form-control'
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
        <br />
        <div class="panel-footer">
        </div>
    </div>

@endsection
