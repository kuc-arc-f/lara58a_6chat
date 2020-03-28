<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Log;
use App\Todo;
use App\User;
//
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**************************************
     *
     **************************************/    
    public function get_guestUserId($mail){
        $ret = "";
        $user = User::where("email", $mail )
        ->first();
        if(!empty($user)){
            $ret = $user["id"];
        }
        return $ret;
    }

}
