@extends('layouts.app')

@section('title', "")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Show  :</h1>
        </div>
        <hr />
        <br />
        <div class="panel-body">
            <div>
                title: {{ $book->title }}
            </div>
            <div>
                content : {{ $book->content }}
            </div>            
            <div>
                date_1 : {{ $book->date_1 }}
            </div>   
            <div>
                radio_1 : {{ $book->radio_1 }}
            </div>                    
            <div>
                check_1 : {{ $book->check_1 }}
            </div>
        </div>
        <hr />
        <br />
        <div class="panel-footer">
            {{ link_to_route('tasks.index', '戻る') }}
        </div>
    </div>

@endsection
