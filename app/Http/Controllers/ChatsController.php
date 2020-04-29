<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Chat;
use App\ChatMember;
use App\ChatPost;

use Log;
use Carbon\Carbon;
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
        $user_id = Auth::id();
        $chat_members = $this->get_chat_members($user_id);
        $chats = Chat::orderBy('id', 'desc')->paginate(20 );
//debug_dump($chat_members->toArray() );
//exit();
        return view('chats/index')->with(compact('chats', 'user' ,'chat_members'));
    }
    /**************************************
     *
     **************************************/
    public function search_index(Request $request){
        $user = Auth::user();
        $user_id = Auth::id();        
        $data = $request->all();
        $chat_members = $this->get_chat_members($user_id);
        $chats = Chat::orderBy('id', 'desc')
        ->where("name", "like", "%" . $data["name"] . "%" )
        ->paginate($this->TBL_LIMIT);
//        ->limit($this->TBL_LIMIT)
//debug_dump($chats);
        $params = $data;
        return view('chats/index')->with(compact(
            'chats', 'user' ,'chat_members','params'
        ));
    }
    /**************************************
     *
     **************************************/
    private function get_chat_members($user_id){
        $chat_members = ChatMember::select([
            "chats.id",
            "chat_members.user_id"
        ])
        ->join('chats',
            'chat_members.chat_id' ,'=', 'chats.id'
        )
        ->where('chat_members.user_id', $user_id)
        ->get();
        return  $chat_members;
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
            return redirect('/chats/next_join?cid=' . $id );
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
    public function next_join(){
        $chat_id = "";
        $chat = [];
        if (isset($_GET['cid'])){
            $chat_id = $_GET['cid'];
            $chat = Chat::find( $chat_id );
//var_dump($_GET['cid'] );
            return view('chats/next_join')->with(compact("chat_id" ,"chat") );
        }
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
    private function get_memberExist($chat_id, $user_id){
        $chat_members = ChatMember::where('chat_id', $chat_id )
        ->where("user_id", $user_id )
        ->get();
        return $chat_members->toArray();
    }
    /**************************************
     *
     **************************************/
    public function add_member(){
        $user_id = Auth::id();   
        $chat_id = "";     
        if (isset($_GET['cid'])) {
            //valid
            $checkMember = $this->get_memberExist($_GET['cid'], $user_id);
            if(!empty($checkMember)){
                $errors =[];
                $errors[] = "このチャットは登録済です。";
                return redirect()->back()->withErrors($errors)->withInput();
            }            
            $chat_id = $_GET['cid'];
            $data = [
                "user_id" => $user_id,
                "chat_id" => $chat_id,
            ];
            $chat_member = new ChatMember();
            $chat_member->fill($data );
            $chat_member->save();
        }
        session()->flash('flash_message', 'チャット参加登録が完了しました');
//        return redirect()->route('chats.index');
        return redirect('/chats/' . $chat_id );
    }
    /**************************************
     * chat情報の表示
     **************************************/    
    public function info_chat(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $chat = Chat::find($id);
            $members = ChatMember::select([
                'chat_members.id',
                'chat_members.user_id',
                'chat_members.created_at',
                'chat_members.token',            
                'users.name as user_name',
            ])
            ->join('users','users.id','=','chat_members.user_id')
            ->where('chat_members.chat_id', $id)
            ->orderBy('chat_members.id', 'desc')
            ->skip(0)->take($this->TBL_LIMIT)
            ->get();
//debug_dump($members );
            return view('chats/info_chat')->with(compact('chat' ,'members' ) );
        }
    }
    /**************************************
     *
     **************************************/
    public function csv_get(){
        if (isset($_GET['chat_id'])) {
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
				->where('chat_id', $_GET['chat_id'] )
				->orderBy('id', 'desc')
				->skip(0)->take($this->TBL_LIMIT)
                ->get(); 
                $chat_posts = $chat_posts->toArray();
                $post_items = [];
                foreach($chat_posts as $chat_post){
                    $dt = new Carbon($chat_post["created_at"]);
                    $chat_post["date_str"] = $dt->format('m-d H:i');
                    $data = [
                        "id" => $chat_post["id"],
                        "user_name" => $chat_post["user_name"],
                        "body" => $chat_post["body"],
                        "date_str" => $chat_post["date_str"],
                    ];
                    $post_items[] = $data;
                }
//debug_dump( $post_items );
                $csvHeader = ['id', 'from' ,'body' , 'date'];
                array_unshift($post_items, $csvHeader);   
                $stream = fopen('php://temp', 'r+b');
                foreach ($post_items as $mdat ) {
                    fputcsv($stream, $mdat );
                }
                rewind($stream);
                $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
                $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
                return response($csv )
                    ->withHeaders([
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="chats.csv"',
                    ]);                
                exit();           
        }
    }
    /**************************************
     * 退会の処理
     **************************************/
    public function delete_member(){
        $user_id = Auth::id();
        if (isset($_GET['cid'])) {
//var_dump($_GET['cid']);
            $chat_member = ChatMember::where('chat_id', $_GET['cid'] )
            ->where('user_id', $user_id)
            ->first();
            if(!empty($chat_member)){
//debug_dump( $chat_member->toArray() );
                $member = ChatMember::find($chat_member->id);
                $member->delete();
            }
            session()->flash('flash_message', '退会が完了しました');
            return redirect()->route('chats.index');            
        }
//exit();
    }
    /**************************************
     *
     **************************************/
    public function test(){
        return view('chats/test');
    }

}
