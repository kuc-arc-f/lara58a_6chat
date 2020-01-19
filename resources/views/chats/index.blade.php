@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
    @endif    
    <div class="panel-heading">
        <BR />
        <h1>Chat Select </h1>
    </div>
    <hr />
    {{ link_to_route('chats.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
    &nbsp;
    <br />
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Action</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <?php //debug_dump($tasks); ?>
            <tbody>
                @foreach ($chats as $chat )
                    <tr>
                        <td class="table-text">{{$chat->id}}
                        </td>
                        <td class="table-text">
                            <h3>{{ link_to_route('chats.show', $chat->name, $chat->id) }}
                            </h3>
                        </td>
                        <td class="table-text">
                            <a href="chats/add_member?cid={{$chat->id}}">[ 参加する ]
                            </a>
                            <!--
                            <a href="chats/delete_member?cid={{$chat->id}}">[ 退会 ]
                            </a>
                            -->
                        </td>
                        <td class="table-text">
                            {{ link_to_route('chats.edit', '編集'
                            , $chat->id, ['class' => 'btn btn-sm btn-default']) }}
                        </td>
                        <td class="table-text">
                            {{ Form::open(['route' => ['chats.destroy', $chat->id], 'method' => 'delete']) }}
                                {{ Form::hidden('id', $chat->id) }}
                                {{ Form::submit('削除', ['class' => 'btn btn-sm btn-default']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br />
        <!-- paginater -->
        {{ $chats->links() }}

        <br />
        <hr />
    </div>
</div>

@endsection
