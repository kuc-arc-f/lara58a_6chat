<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\AppConst;
use App\Chat;
use App\ChatMember;
use App\ChatPost;
//
class ApiChatsController extends Controller
{
    /**************************************
     *
     **************************************/
    public function __construct(){
        $this->TBL_LIMIT = 1000;
    }
    /**************************************
     *
     **************************************/    
    public function update_token(Request $request){
        $data = $request->all();
        $chat_member = ChatMember::find((int)$data["chat_member_id"]);
        $chat_member["token"] = $data["token"];
//        $chat_member->fill($request->all());
        $chat_member->save();
        return response()->json( $data );
    }    
    /**************************************
     * 投稿の更新
     **************************************/
    public function update_post(Request $request){
        $data = $request->all();
        $chat_post = new ChatPost();
        $chat_post->fill($data);
        $chat_post->save();
        return response()->json( $data );
    }    
    /**************************************
     * chat_postsの取得
     **************************************/
    public function get_post()
    {   
        if (isset($_GET['cid'])) {
            $chat_posts = ChatPost::orderBy('id', 'asc')
                ->where('chat_id', $_GET['cid'] )
                ->get();
//                ->limit($this->TBL_LIMIT)
            return response()->json($chat_posts );
        }
    }  
    /**************************************
     *
     **************************************/ 
    public function get_send_members(Request $request){
        $data = $request->all();
//var_dump( $data );
        $member = ChatMember::select([
            'chat_members.id',
            'chat_members.user_id',
            'chat_members.token',            
        ])
        ->join('users','users.id','=','chat_members.user_id')
        ->where('chat_members.chat_id', $data["chat_id"])
        ->where('users.email', $data["mail"])->first();
        ;

//var_dump( $member );
        $ret =[
            "ret" => 1,
            "member" =>  $member,
        ];
///        $const = new AppConst;
        return response()->json( $ret );
    } 
    /**************************************
     * 投稿の更新, FCM client
     **************************************/
    public function update_post_client(Request $request){
        $data = $request->all();
        $chat_post = new ChatPost();
        $chat_post->fill($data);
        $chat_post->save();
        return response()->json( $data );
    }     

}
