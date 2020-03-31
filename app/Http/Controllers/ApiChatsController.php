<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\AppConst;
use App\Chat;
use App\ChatMember;
use App\ChatPost;
use Carbon\Carbon;
//
class ApiChatsController extends Controller
{
	/**************************************
	 *
	 **************************************/
	public function __construct(){
		$this->TBL_LIMIT = 500;
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
			$chat_posts = ChatPost::select([
				'chat_posts.id',
				'chat_posts.chat_id',
				'chat_posts.user_id',
				'chat_posts.title',
				'chat_posts.body',
				'chat_posts.created_at',
				'users.name as user_name',
				])
				->join('users','users.id','=','chat_posts.user_id')
				->where('chat_id', $_GET['cid'] )
				->orderBy('id', 'desc')
				->skip(0)->take($this->TBL_LIMIT)
				->get();
			$chat_posts = $chat_posts->toArray();
			$post_items = [];
			foreach($chat_posts as $chat_post){
				$dt = new Carbon($chat_post["created_at"]);
				$chat_post["date_str"] = $dt->format('m-d H:i');
				$chat_post["body_org"] = $chat_post["body"];
				$chat_post["body"] = nl2br($chat_post["body"]);
				$post_items[] = $chat_post;
			}
//debug_dump($dt->format('m-d H:i') );
//debug_dump($post_items );
//exit();
			return response()->json($post_items );
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
		
		//valid ,admin_user add
		$chat_post = new ChatPost();
		$chat_post->fill($data);
		$chat_post->save();
		return response()->json( $data );
	} 
	/**************************************
	 *
	 **************************************/
	public function delete_post(Request $request){
		$data = $request->all();
		$id = (int)$data["id"];
		$chat_post = ChatPost::find($id);
		$chat_post->delete();
//		session()->flash('flash_message', '削除が完了しました');
		session()->flash('flash_message', 'delete complete ID: ' . $id);
		return response()->json( $data );
	}

}
