@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <br />
        <h1>Test3</h1>
    </div>
    <hr />
    <div class="panel-body">
        body:<br />
        @include('element.elem_test',
        ['title' => 'タイトル-123','description' => 'ディスクリプション-123'])
    </div>
</div>
<hr />
<div>

@endsection
