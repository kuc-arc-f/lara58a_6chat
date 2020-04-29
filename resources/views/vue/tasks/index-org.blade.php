@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')
<div id="app">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Vue - タスク一覧</h1>
            <hr /> 
            {{ link_to_route('vue_tasks.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
            <br /><br />
        </div>
        <div class="panel-body">
            <table class="table task-table">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th> </th>
                </thead>
                <tbody v-for="task in tasks" v-bind:key="task.id">
                    <tr>
                        <td>@{{ task.id }}
                        </td>
                        <td class="table-text">
                        <h4>
                            <a v-bind:href="'/vue_tasks/' + task.id">@{{ task.title }}
                            </a>
                        </h4>
                        </td>                        
                        <td class="table-text">
                            <a v-bind:href="'/vue_tasks/' + task.id + '/edit'"
                             class="btn btn-outline-primary">Edit
                            </a>
                        </td>
                    </tr>                    
                </tbody>
            </table>
            <br />
            <br />
        </div>
    </div>
</div>
<!-- -->
<script>
new Vue({
    el: '#app',
    created () {
        this.getTasks(0);
    },    
    data: {
        tasks : [],
    },
    methods: {
        getTasks (complete) {
            axios.get('/api/apitasks/get_tasks')
                .then(res =>  {
                    this.tasks = res.data
//console.log(res.data )
            })            
        },
    }
});
</script>
<!-- -->
@endsection
