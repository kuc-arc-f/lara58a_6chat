@extends('layouts.base')

@section('title', 'タスク一覧')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            タスク一覧
        </div>
        <div class="panel-body">
            <form>
              <input name="text" id="txt_1" value="123" ></input>
            </form>

            <br />
            new:<br />
            {{ link_to_route('tasks.create', '[ create ]' ) }}
            <br />
            <br />
            <a href="make/"  class="btn btn-primary ">詳細はこちら </a><br />
            <a href="#" onClick="a1();">[ test1 ]</a>
        </div>
    </div>
    <hr />
    <div>
    <!-- vue -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <h1>Vue.js test</h1>
        <div id="app">
        Hello @{{ message }} !
        </div>
    </div>
    <hr />

    <!-- -->
    <script>
    function a1(){
        var v1 = $('#txt_1').val();
        alert(v1);

    }
    </script>

@endsection
