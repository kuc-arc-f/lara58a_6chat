@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <BR />
        <h1>Depts 一覧 </h1>
        <BR />
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>ID</th>
                <th>name</th>
                <th>編集</th>
                <th>削除</th>
            </thead>
            <tbody>
            @foreach ($depts as $dept)
                <tr>
                    <td class="table-text">{{ $dept->id }}
                    </td>
                    <td class="table-text">
                        {{ link_to_route('depts.show', $dept->name, $dept->id) }}
                    </td>
                    <td class="table-text">
                        {{ link_to_route('depts.edit', '編集'
                        , $dept->id, ['class' => 'btn btn-sm btn-primary']) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- paginater -->
        {{ $depts->links() }}        
        <br />
        <br />
        <hr />
        {{ link_to_route('depts.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
        <br />
        <br />
    </div>
</div>

@endsection
