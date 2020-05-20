<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;

//
class MessagesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->TBL_LIMIT = 500;
	}    
	/**************************************
	 *
	 **************************************/
	public function index()
	{
		$user = Auth::user();
//var_dump("#index");
		$messages = Message::orderBy('id', 'desc')->paginate( $this->TBL_LIMIT );
		return view('messages/index')->with(compact('user', 'messages'));
	}
	/**************************************
	 *
	 **************************************/
	public function create()
	{
		return view('messages/create')->with('message', new Message());
	}	
	/**************************************
	 *
	 **************************************/    
	public function store(Request $request)
	{
		$user_id = Auth::id();
		$data = $request->all();
		$message = new Message();
		$message["user_id"]= $user_id;
		$message["from_id"]= $user_id;
		$message["type"]= 1;
		$message["status"]= 1;
		$message->fill($data );
//debug_dump($message );
//exit();				
		$message->save();
		session()->flash('flash_message', 'complete, message save');
		return redirect()->route('messages.index');
	}
	/**************************************
	 *
	 **************************************/
	public function show($id)
	{
		$message = Message::find($id);
		//status_set
		$message["status"] = 2;
		$message->save();

		$content = preg_replace('/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/', 
		'<A href="\\1\\2">\\1\\2</A>', $message->content );
//		$message["content"] = nl2br($content);
		$message["content"] = $content;
		$to_user = User::where('id', $message->to_id)
		->first();
		$from_user = User::where('id', $message->from_id )
		->first();
//debug_dump($message );
//exit();
		return view('messages/show')->with(compact(
			'message','to_user' ,'from_user'
		));        
	} 
	/**************************************
	 * 送信者から、詳細表示
	 **************************************/
	public function show_sent()
	{
		$edit_mode = true;
		if (isset($_GET['id'])){
			$message = Message::find($_GET['id']);
			$to_user = User::where('id', $message->to_id)
			->first();
			$from_user = User::where('id', $message->from_id )
			->first();			
//debug_dump($message );
// exit();
			return view('messages/show')->with(compact(
				'message','to_user' ,'from_user','edit_mode'
			));        
		}
	}	 
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect()->route('messages.index');
	}	
	/**************************************
     *
     **************************************/
	public function reply()
	{
		if (isset($_GET['id'])){
			$message = Message::find($_GET['id']);
			$message->content = "";
			$from_user = User::where('id', $message->from_id )
			->first();
//debug_dump($message );
//exit();
		}
		return view('messages/reply')->with(compact('message', 'from_user') );
	}

}
