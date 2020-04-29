@extends('layouts.app')

@section('title', "show")

@section('content')

<div class="panel panel-default">
    <br />
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div>
            {{ link_to_route('todos.index', '戻る' ,null, ['class' => 'btn btn-outline-primary']) }}
            <br />
            <br />
            <h1>{{ $todo->title }} </h1>
            <p>date : {{ $todo->created_at->format('Y-m-d') }}</p>
        </div>
        <hr />
        <div>
            <!-- content :  
            <br /><br />
            -->
            <div id="content_wrap">
            </div>
        </div>  
        <hr />
        <div>
            status: 
            <span class="badge badge-secondary" style="font-size: 24px;">{{ $complete_items[$todo->complete] }}
            </span>
        </div>   

        <div class="form-group">
            {!! Form::hidden('content_hidden', $todo->content, [
                'id' => 'content-hidden', 'class' => "form-control" ,'required'=>'required' ]) 
            !!}
        </div>

    </div>
    <hr />
    <br />
    <div class="panel-footer">
    </div>
</div>
<!-- -->
<script>
$(function() {
    //MD_convert
    var content = $("#content-hidden").val();
    content= marked(content);
//    console.log(content);
    $("#content_wrap").append(content);
});
</script>
    
@endsection

