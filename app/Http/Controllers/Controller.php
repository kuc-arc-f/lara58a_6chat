<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

use Log;
use App\Todo;
use App\User;
use App\Message;
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
    /**************************************
     *
     **************************************/ 
    public function get_message_items($user_id ){
        $messages = Message::orderBy('messages.id', 'desc')
        ->select([
            'messages.id',
            'messages.created_at',
            'messages.title',
            'users.name',
        ])        
        ->leftJoin('users','users.id','=','messages.from_id')
        ->where('messages.to_id', $user_id )
        ->where('messages.status', 1 )
        ->skip(0)->take( 10 )
        ->get();
        $post_items = [];
        foreach($messages as $item ){
            $item["title"] = mb_substr( $item->title , 0, 10 );
            $dt = new Carbon($item["created_at"]);
            $item["date_str"] = $dt->format('m-d H:i');
            $post_items[] = $item;
        }
        $messages = $post_items;
        return $messages;
    }      

}
