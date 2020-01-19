@extends('layouts.app')

@section('title', "" )

@section('content')
<div class="panel panel-default">
    <h1>depts - show</h1>
    <hr />
    <br />
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div>
            name: {{ $dept->name }}
        </div>
    </div>
    <hr />
    <h3>member :</h3>
    <div class="member_wrap">
    <ul>
        @foreach ($members as $member )
        <li>{{ $member->name }}
        </li>
        @endforeach
    </ul>
    </div>

    <hr />
    <div class="panel-footer">
        {{ link_to_route('depts.index', '戻る') }}
    </div>
</div>
@endsection
