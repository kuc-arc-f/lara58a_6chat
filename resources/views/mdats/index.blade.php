@extends('layouts.app')
@section('title', '')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h1>mDat 一覧 </h1>
    </div>
    <hr />
    <!-- error_msg -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
    @endif    
    <div class="row" >
        <div class="col-sm-6">
            {{ link_to_route('mdats.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
        </div>
        <div class="col-sm-6" style="text-align:center;">
            <a href ="/mdats/chart?ym={{$now_month}}" class="btn btn-outline-primary">Chart</a>
        </div>    
    </div>
    <hr />
    <div class="row csv_import_wrap">
        <!--
        <p>Import :</p>
        -->
        <div class="col-sm-8">
            <form action="/mdats/csv_import" method="post" enctype="multipart/form-data" id="csvUpload">
                {{ csrf_field() }}
                <input type="file" value="ファイルを選択" name="csv_file"
                required="required" class="btn btn-outline-primary" />
                <button type="submit" class="btn btn-outline-primary">CSVインポート
                </button>
            </form>        
        </div>
        <div class="col-sm-4">
            <a href ="/mdats/csv_get?ym={{$now_month}}"
             class="btn btn-outline-primary"> CSV出力 
            </a>
        </div>        
    </div>
    <hr />
    <div class="month_move_wrap" style="text-align: center; font-size : 1.2rem;">
        <a href="?ym={{ $prev }}"><i class="fas fa-arrow-circle-left"></i>
        </a>&nbsp;
        <label>
            <input type="month" id="month" name="month" value="{{$now_month}}"   />
        </label>
        <input type="button" onClick="changeMonth();" value="変更"
        class="btn btn-outline-primary btn-sm td_edit">&nbsp;
        <a href="?ym={{ $next }}"><i class="fas fa-arrow-circle-right"></i>
        </a>&nbsp;    
    </div>    
    <div class="panel-body">
        <table class="table table-striped task-table">
        <thead>
            <th>Id</th>
            <th>Date</th>
            <th>Hight</th>
            <th>Low</th>
            <th>編集</th>
            <th>削除</th>
        </thead>
        <tbody>
            @foreach ($mdats as $mdat )
            <tr>
                <td class="table-text">
                    {{ $mdat->id  }}
                </td>
                <td class="table-text">
                    {{ $mdat->date  }}
                </td>
                <td class="table-text">
                    {{ $mdat->hnum  }}
                </td>
                <td class="table-text">
                    {{ $mdat->lnum  }}
                </td>
                <td class="table-text">
                    {{ link_to_route('mdats.edit', '編集'
                    , $mdat->id, ['class' => 'btn btn-sm btn-outline-primary']) }}
                </td>
                <td class="table-text">
                    {{ Form::open(['route' => ['mdats.destroy', $mdat->id], 'method' => 'delete']) }}
                        {{ Form::hidden('id', $mdat->id) }}
                        {{ Form::submit('削除', ['class' => 'btn btn-sm btn-outline-danger']) }}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <br />
        <!-- paginate -->
        {{ $mdats->links() }}

        <br />
        <hr />
        <br />
        <br />
    </div>
</div>
<!-- -->
<!-- -->
<style>
.today{
    background : #B3E5FC;
}
.table .td_cls{
    width : 80px;
    min-height : 60px;
}
.table .content_text{
    color : gray;
    font-size : 11pt;
    margin : 8px 0px;
}
.table .td_edit{
    font-size : 11pt;
    /*     margin : 8px: 8px; */
}
.table th{
    text-align: center;
}
#month{
    width : 180px;
}
.month_move_wrap .fa-arrow-circle-left{
    font-size : 2.2rem;
}
.month_move_wrap .fa-arrow-circle-right{
    font-size : 2.2rem;
}
</style>
<script>
function changeMonth(){
    var nowMonth= $("#month").val();
    var url = "/mdats?ym=" +nowMonth;
//    console.log( url );
    location.href = url;
}
</script>
@endsection
