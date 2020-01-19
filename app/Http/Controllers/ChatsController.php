<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Chat;
use App\ChatMember;
use App\ChatPost;
use Log;
//
class ChatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $chats = Chat::orderBy('id', 'desc')->paginate(10 );
        return view('chats/index')->with(compact('chats', 'user'));
    }
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('chats/create')->with('chat', new Chat());
    }    
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $user_id = Auth::id();        
        $inputs = $request->all();
        $chat = new Chat();
        $chat["user_id"]= $user_id;

        $chat->fill($inputs);
        $chat->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('chats.index');
    }
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $chat = Chat::find($id);
        $chat_members = ChatMember::where('chat_id', $id)
            ->where('user_id' , '<>', $user_id)
            ->get(); 
//debug_dump($chat_members->toArray() );

        $chat_member = ChatMember::where('chat_id', $id)
            ->where('user_id', $user_id)
            ->first(); 
        if(empty($chat_member)){
            session()->flash('flash_message', 'このチャットに、参加していません。');
            return redirect()->route('chats.index');
        }

        $chat_posts = ChatPost::where('chat_id', $id)
            ->orderBy('id', 'desc')
            ->limit($this->TBL_LIMIT)
            ->get(); 
        $chat_posts_json = json_encode($chat_posts->toArray() );
        return view('chats/show')->with(compact(
            "chat", "user_id", "id", "chat_member",
             "chat_members","user", "chat_posts", "chat_posts_json"
        ) );
    }    
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $chat = Chat::find($id);
        return view('chats/edit')->with('chat', $chat );
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $data = $request->all();
//debug_dump($data );
        $chat = Chat::find($id);
        $chat->fill($data);
        $chat->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('chats.index');
    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $chat = Chat::find($id);
        $chat->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect()->route('chats.index');
    }    
    /*
    public function home(){
        return view('chats/home')->with('chat', null );
    }      
    */
    /**************************************
     *
     **************************************/
    public function add_member(){
        $user_id = Auth::id();        
        if (isset($_GET['cid'])) {
            $chat_id = $_GET['cid'];
//var_dump($_GET['cid'] );
            $data = [
                "user_id" => $user_id,
                "chat_id" => $chat_id,
            ];
            $chat_member = new ChatMember();
//            $chat_member["user_id"]= $user_id;
            $chat_member->fill($data );
            $chat_member->save();
        }
//exit();
        session()->flash('flash_message', 'チャット参加登録が完了しました');
        return redirect()->route('chats.index');
    }

}
