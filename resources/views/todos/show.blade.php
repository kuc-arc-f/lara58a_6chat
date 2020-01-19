@extends('layouts.app')

@section('title', "show")

@section('content')

<div class="panel panel-default">
    <br />
    <h1>Show :</h1>
    <hr />
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div>
            <h3>{{ $todo->title }} </h3>
        </div>
        <hr />
        <div>
            <!--  -->
            content :<br /><br />
            <div id="content_wrap">
            </div>
        </div>  
        <hr />
        <div>
            complete:  {{ $complete_items[$todo->complete] }}
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
        {{ link_to_route('todos.index', '戻る') }}
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

