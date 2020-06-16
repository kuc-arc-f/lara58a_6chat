<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Message;
use App\User;
//
class ApiMessagesController extends Controller
{
	//
	/**************************************
	 *
	 **************************************/
	public function __construct(){
//		$this->middleware('auth');
		$this->TBL_LIMIT = 500;
	}
	/**************************************
	 *
	 **************************************/
	public function get_item(Request $request)
	{   
		$data = $request->all();
//exit();
		$messages = Message::select([
			'messages.id',
			'messages.title',
			'messages.created_at',
			'messages.status',
			'users.name as user_name',
		])
		->leftJoin('users','users.id','=','messages.from_id')
		->orderBy('id', 'desc')
		->where('to_id' , $data["user_id"] )
		->limit($this->TBL_LIMIT)
		->get();
		$messages = $this->get_receive_items($messages);
		return response()->json($messages);
	}
	/**************************************
	 *
	 **************************************/
	private function get_receive_items($messages){
		$post_items = [];
		foreach($messages as $item ){
			$dt = new Carbon($item["created_at"]);
			$item["date_str"] = $dt->format('m-d H:i');
			/*
			$body = $item["body"];
			$body = preg_replace('/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/', 
			'<A href="\\1\\2">\\1\\2</A>', $body);
			$item["body_org"] = $body;			
			*/
			$post_items[] = $item;
		}
		return $post_items;
	}
	/**************************************
	 *
	 **************************************/
	public function get_sent_item(Request $request)
	{   
		$data = $request->all();
		$messages = Message::select([
			'messages.id',
			'messages.title',
			'messages.created_at',
			'messages.status',
			'users.name as user_name',
		])
		->leftJoin('users','users.id','=','messages.to_id')
		->orderBy('id', 'desc')
		->where('from_id' , $data["user_id"] )
		->limit($this->TBL_LIMIT)
		->get();	
		$messages = $this->get_receive_items($messages);

		return response()->json($messages );
	}
	/**************************************
	 *
	 **************************************/
	public function get_user(Request $request)
	{   
		$data = $request->all();
//exit();
		$user = User::where('email', $data["mail"])
		->first();
		return response()->json($user );
	}
	/**************************************
	 *
	 **************************************/
	public function get_last_item(Request $request)
	{   
		$data = $request->all();
		$messages = Message::select([
			'messages.id',
			'messages.title',
		])
		->orderBy('id', 'desc')
		->where('to_id' , $data["user_id"] )
		->first();
		return response()->json($messages );
	}
    /**************************************
     *
     **************************************/    
    public function search(Request $request){
        $data = $request->all();
/*
		$messages = Message::orderBy('id', 'desc')
		->where("title", "like", "%" . $data["search_key"] . "%" )
        ->limit($this->TBL_LIMIT)
		->get();
*/
		$messages = Message::orderBy('messages.id', 'desc')
		->select([
			'messages.id',
			'messages.title',
			'messages.created_at',
			'messages.status',
			'users.name as user_name',
		])
		->join('users','users.id','=','messages.from_id')
		->where("messages.title", "like", "%" . $data["search_key"] . "%" )
		->where("users.email", "like", "%" . $data["search_mail"] . "%" )
		->where('to_id' , $data["user_id"] )
        ->limit($this->TBL_LIMIT)
		->get();

		$messages = $this->get_receive_items($messages);
        return response()->json( $messages  );
    }

}
