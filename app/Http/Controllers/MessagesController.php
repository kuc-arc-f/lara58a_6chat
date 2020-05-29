<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Message;
use App\MessageFile;
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
//exit();
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
		$message->save();
		$ret = true;
		if(isset($data["attach_file"])){
			$validator = Validator::make($request->all(), [
//				'attach_file' => 'required|max:1024'
				'attach_file' => 'required|max:512'
			]);
			if ($validator->fails())
			{
				session()->flash('flash_message', 'ファイルアップロードに失敗しました。');
				return back()->withInput()->withErrors($validator);
			}			
//debug_dump($data["attach_file"]);
			$ret = $this->upload_file($request, $message->id );
		}
// exit();							
		if($ret == false){
			session()->flash('flash_message', 'ファイルアップロードに失敗しました。');
			return redirect()->back()->withErrors($errors)->withInput();
		}else{
			session()->flash('flash_message', 'complete, message save');
		}
		return redirect()->route('messages.index');
	}
	/**************************************
	 *
     **************************************/
	private function upload_file(Request $request, $message_id ){
		$ret = true;
//		$datetime = strtotime(date('YmdHis'));
		$temporary_file = $request->file('attach_file')->store('message_files_tmp');
		$origiinal_name = $request->file('attach_file')->getClientOriginalName();
//var_dump( "temporary_file=". $temporary_file );
//var_dump($origiinal_name );
		$filename = $message_id."_" . $origiinal_name;
//var_dump($temporary_file );
		$storage_path = storage_path('app/') . $temporary_file;
		// $public_path = public_path() . "/files/" . $origiinal_name;
		Storage::copy($temporary_file , 'message_files/' . $filename );
		//delete
		Storage::delete($temporary_file );

		// fname-save
		$message_file = new MessageFile();
		$message_file["message_id"]= $message_id;
		$message_file["name"]= $filename;
		$message_file->save();

		return $ret;
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
		// MessageFile
		$message_file = MessageFile::where('message_id', $id )
		->first();
//exit();
		return view('messages/show')->with(compact(
					'message','to_user' ,'from_user', 'message_file'
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
		// MessageFile
		$message_file = MessageFile::where('message_id', $_GET['id'] )
		->first();

			return view('messages/show')->with(compact(
				'message','to_user' ,'from_user','edit_mode',
				'message_file'
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
	/**************************************
     *
     **************************************/
	public function export(){
		if (isset($_GET['id'])){
			$id  = $_GET['id'];
			$message = Message::find($id);
			$dt = new Carbon($message->created_at);
			$datetime = $dt->format('Ymd_Hi');

			$to_user = User::where('id', $message->to_id)
			->first();
			$from_user = User::where('id', $message->from_id )
			->first();			
			//text-get
			$stream = fopen('php://temp', 'r+b');
			fwrite($stream, "Title : " . $message->title . "\r\n" );
			fwrite($stream, "Created : " . $message->created_at . "\r\n" );
			fwrite($stream, "From : " . $from_user->name . "\r\n" );
			fwrite($stream, "To : " . $to_user->name . "\r\n" );
			fwrite($stream, "ID : " . $message->id . "\r\n" );
			fwrite($stream, "=========================\r\n" );
			fwrite($stream, $message->content . "\r\n" );
			rewind($stream);
//			$csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
			$csv = stream_get_contents($stream);
			$attachment = "attachment; filename=message_{$datetime}.txt";
//var_dump( $s );
//exit();
			return response($csv )
				->withHeaders([
					'Content-Type' => 'text/csv',
					'Content-Disposition' => $attachment,
				]);			
			exit();
		}
	}
	/**************************************
     *
     **************************************/
	public function test(){
		$messages = Message::orderBy('id', 'asc')->get();
		foreach($messages as $message ){
			$message_file = MessageFile::where('message_id', $message->id )
			->first();
			if(empty($message_file) == false){
//debug_dump($message_file->name );
//				$storage_path = storage_path('app/') . "message_files/" . $message_file->name;
				$storage_path = "message_files/" . $message_file->name;
//debug_dump($storage_path );
				Storage::delete($storage_path );
			}

		}
		//db-delete
		foreach($messages as $message ){
			$message = Message::find($message->id );
//debug_dump($message->id );
			$message_file = MessageFile::where('message_id', $message->id )
			->first();
			if(empty($message_file) == false){
//debug_dump($message_file->id );
				$message_fileOne = MessageFile::find($message_file->id );
debug_dump($message_fileOne->id );
				$message_fileOne->delete();
			}
			$message->delete();
		}
exit();

	}

}
