<?php

namespace App\Libs;
use App\Libs\AppConst;
//
class LoginState{
    //
    public function checkLogin(){
        $ret=array();
        $const = new AppConst;
        session_start();
        if(isset($_SESSION[ $const->sessParam_user ])){
            $ret=$_SESSION[$const->sessParam_user];
        }
        return $ret;
    }

}
