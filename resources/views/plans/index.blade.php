@extends('layouts.app')
@section('title', '一覧')

@section('content')
<br />
<div class="row">
    <div class="col-sm-6">
        <h1>Plans: {{ $month }}</h1>
    </div>
    <div class="col-sm-6"  style="padding: 8px 8px; text-align: right;">
        {{ link_to_route('plans.create', '予定の作成' ,null, ['class' => 'btn btn-primary']) }}
    </div>
</div>
<hr />
<div class="flex-center position-ref full-height">
    <div class="content">
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
        <table class="table table-bordered">
            <tr>
                <th style="color :red;">日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th style="color :blue;">土</th>
            </tr>
            @foreach ($weeks as $days)
                <tr>
                    @foreach ($days as $day)
                    <?php
                    $today_class = "none";
                    if($day["today"]){ $today_class = "today"; }
                    $day_content = mb_substr($day["content"], 0, 6 );
                    ?>
                    <td class="{{ $today_class }} td_cls">
                        <?php if(!empty($day_content) ){ ?>
                            <a href="/plans/{{$day["id"]}}">
                            <div>
                                {{ $day["day"] }}<br />
                                <p class="content_text">{{ $day_content }}</p>
                            </div>
                            </a>  
                            <a class="btn btn-outline-primary btn-sm td_edit" href="/plans/{{$day["id"]}}/edit">編集
                            </a>                          
                        <?php }else{ ?>
                            <?php if(isset($day["date"])){ ?>
                                <a href="/plans/create?ymd={{$day["date"]}}">
                                <div>
                                    {{ $day["day"] }}<br />
                                    <?php //var_dump($day["date"]); ?>
                                    <br />
                                    <br />
                                </div>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div><!-- content_end -->
</div>
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
<!-- -->
<script>
function changeMonth(){
    var nowMonth= $("#month").val();
    var url = "/plans?ym=" +nowMonth;
//    console.log( url );
    location.href = url;
}
</script>

@endsection
	