<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>knaka0209.net</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
     <!-- js -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- PWA -->
    <link rel="manifest" href="/pwa/manifest.json">
</head>
<body>
    <div class="top-right links" >
        @auth
            <a href="{{ url('/home') }}" class="btn btn-outline-primary">Home</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
            @endif
        @endauth
    </div>
    <!-- container_top -->
    <div id="div_img_main2" class="cover" style="" valign="bottom">
        <div id="div_img_layer">
            <!-- pages -->
            <h1>Sample app<br>
                for knaka0209.net
            </h1>
        </div>
    </div>
    <!-- container -->
    <div class="container" id="id_main_conte">
        <div class="row conte" id="id_row_service" style="margin-top:10px;">
            <div class="col-sm-12" style="text-align:center;">
            <h2 class="h4_td_title">Summary</h2>
            <hr class="hr_ex1">
            </div>
        </div>
        <br />
        <div class="row conte" style="margin-bottom: 200px;">
            <div class="col-sm-4">
                <a href="/about" class="btn btn-outline-primary" >Learn more</a>
            </div>
            <div class="col-sm-8">
            <h3> Laravel 5 , vue.js app sample</h3>
            <p> <br>
            </p>
            </div>
        </div>        
    </div>
    <!-- footer -->
    @include('footer', [])
</body>
</html>
<!-- -->
<style>
.top-right{
    padding : 10px;
    text-align: right;
}
div#div_img_main2 {
    height: 300px;
    color: #FFF;
    margin: 0 0 0px;
    width: 100%;
    background: #80CBC4;
    background-size: cover;
    text-align: center;
}
#div_img_layer {
    width: 100%;
    height: 100%;
}
#div_img_main2 h1 {
  margin: 0px;
  font-weight: bold;
  border-radius: 5px;
  padding: 3em;
} 
.h4_td_title {
  color: #FF7043;
  font-weight: bold;
}   
/* SP */
@media screen and (max-width: 480px){
    #div_img_main2 h1{
        font-size: 28px;
        padding: 2em 1em;
    }
}
</style>
<!-- --->
<script>
"use strict";
registSW();
function registSW() {
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
        navigator.serviceWorker.register('/sw.js', { scope: './' }).then(function (registration) {
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            console.log('ServiceWorker registration failed: ', err);
        });
        });
    }
}
</script>

