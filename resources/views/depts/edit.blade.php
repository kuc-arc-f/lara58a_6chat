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
            {!! Form::model($dept, ['route' => ['depts.update', $dept->id], 'method' => 'patch', 
            'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'name', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', $dept->name, [
                            'id' => 'dept-name', 'class' => 'form-control'
                        ]) !!}
                    </div>
                </div>
                <hr />
                <?php
                ?>
                <h3>member:</h3>
                <div class="member_wrap">
                <?php for($i=1 ; $i <= 5 ; $i++){ 
                    $member_name = "";
                    $member_id = $i;
                    if(isset($members[$i-1])){
                        $member_name = $members[$i-1]->name;
                        $member_id = $members[$i-1]->id;
                        // /debug_dump($members[$i-1]->name );
                    }
                    $member_label = "name-" . $i;
                    ?>
                    <div class="form-group">
                        {!! Form::label($member_label, $member_label, ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text("member[{$member_id}]", $member_name, [
                                    'class' => "form-control"  ]) 
                            !!}                    
        
                        </div>
                    </div>
                <?php } ?>                    
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
            {{ link_to_route('depts.index', '戻る') }}
        </div>
    </div>

@endsection
