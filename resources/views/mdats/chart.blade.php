@extends('layouts.app')

@section('title', "chart")

@section('content')

<div class="panel panel-default">
    <div id="app">
        <h1>Chart</h1>
        <div style="text-align : right;">
            <a class="btn btn-outline-primary" href="/mdats"> リストに戻る </a>
        </div>
        <hr />
        <canvas id="myChart" ></canvas>
    </div>
    
</div>

<!-- -->
<script>
var items = [];
var color_red = 'rgb(255, 99, 132)';
var color_blue = 'rgb(54, 162, 235)';
//
function get_config(items){
    var config = {
            type: 'line',
            data: {
                labels: items.lbl ,
                datasets: [{
                    label: 'H-num',
                    fill: false,
                    backgroundColor: color_red,
                    borderColor: color_red,
                    data: items.hnum ,
                }, {
                    label: 'L-num',
                    fill: false,
                    backgroundColor: color_blue,
                    borderColor: color_blue,
                    data: items.lnum ,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: ' '
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,  
                        ticks: {
                            autoSkip: false,
                        },
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };
        return config;
}
//
function convert_cahrt_arr( items ){
    var hnum = []
    var lnum = []
    var lbl = []
    items.forEach( function (item) {
//console.log( item );    
        lbl.push( item.date )                
        hnum.push( item.hnum )                
        lnum.push( item.lnum )                
    });
    var ret= {
        "lbl" : lbl,
        "hnum" : hnum,
        "lnum" : lnum,
    }
    return ret;
}
//
function get_chart_data(){
    var ctx = document.getElementById('myChart').getContext('2d');
    axios.get("/api_mdats/index").then(res =>  {
        var items = res.data.docs
        var arr =[];
        items.forEach( function (item) {
console.log( item.date_str );                    
            arr.push(item)
        });      
        arr = convert_cahrt_arr(arr)
//console.log( arr );                    
        config = get_config(arr);
        window.myLine = new Chart(ctx, config);
    });
}
//
function get_mdats(){
    @foreach ($mdats as $mdat )
    var dat = {
		"id" : {{$mdat->id}},
		"date" : "{{$mdat->date}}",
		"hnum" : {{$mdat->hnum}},
		"lnum" : {{$mdat->lnum}},
	}
    items.push( dat );

    @endforeach
    return items;
}
//
$(function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var mdats= get_mdats();
console.log(mdats);
    var arr = convert_cahrt_arr( mdats )
//console.log( arr );                    
    config = get_config(arr);
    window.myLine = new Chart(ctx, config);    
}); 
</script>
@endsection
