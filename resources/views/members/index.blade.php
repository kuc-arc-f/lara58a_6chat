@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <BR />
        <h1>Members 一覧 </h1>
        <BR />
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>title</th>
                <th>dept</th>
                <th>編集</th>
                <th>削除</th>
            </thead>
            <tbody>
            @foreach ($members as $member)
                <tr>
                    <td class="table-text">
                        {{ link_to_route('members.show', $member->name, $member->id) }}
                    </td>
                    <td class="table-text">
                        {{  $member->dept_name }}
                    </td>
                    <td class="table-text">
                        {{ link_to_route('members.edit', '編集'
                        , $member->id, ['class' => 'btn btn-sm btn-default']) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- paginater -->
        {{ $members->links() }}        
        <br />

        <br />
        <hr />
        {{ link_to_route('members.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
        <br />
        <br />
    </div>
</div>

@endsection
