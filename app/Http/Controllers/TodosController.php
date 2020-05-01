<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Todo;
use App\Libs\AppConst;

//
class TodosController extends Controller
{
    //
    public function __construct()
    {
        $this->TBL_LIMIT = 500;
//        $this->middleware('auth');
    }
    /**************************************
     *
     **************************************/
    public function index(Request $request)
    {   
        $const = new AppConst;
        $user_id  = $this->get_guestUserId( $const->guest_user_mail );
        $complete = 0;
        $inputs = $request->all();
        if(isset($inputs["complete"]) ){
            $complete = $inputs["complete"];
        }
        $todos = Todo::orderBy('id', 'desc')
        ->where("complete" , $complete)
        ->where("user_id" , $user_id )
        ->paginate(20 );
//        ->get();
        return view('todos/index')->with(compact('todos' ,'complete') );
    }    
    /**************************************
     *
     **************************************/
    public function search_index(Request $request){
        $const = new AppConst;
        $user_id  = $this->get_guestUserId( $const->guest_user_mail );
        $data = $request->all();  
        $params = $data;   
        if(isset($data["complete"]) ){
            $complete = $data["complete"];
        }
        $todos = Todo::orderBy('id', 'desc')
        ->where("title", "like", "%" . $data["name"] . "%" )
        ->where("complete" , $complete)
        ->where("user_id" , $user_id )
        ->paginate($this->TBL_LIMIT);
//        ->get();        
//debug_dump( $data );        
//exit();
        return view('todos/index')->with(compact('todos' ,'complete' ,'params') );
    }
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('todos/create')->with('todo', new Todo());
    }    
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $const = new AppConst;
        $user_id  = $this->get_guestUserId( $const->guest_user_mail );
//debug_dump( $user_id );
//exit();        
        $inputs = $request->all();
        $inputs["complete"] = 0;
        $inputs["user_id"] = $user_id;

        $todo = new Todo();
        $todo->fill($inputs);
        $todo->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('todos.index');
    }
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $todo = Todo::find($id);
        $complete_items = $this->get_complete_items();
        return view('todos/show')->with(compact('todo', 'complete_items') );        
    }    
    /**************************************
     *
     **************************************/
    private function get_complete_items(){
        $items =  array(
            '0' => '未完了', '1' => '完了済',
        );
        return $items;
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $todo = Todo::find($id);
        $complete_items = $this->get_complete_items();
        return view('todos/edit')->with(compact('todo', 'complete_items') );
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->fill($request->all());
        $todo->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('todos.index');
    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect()->route('todos.index');
    }    


}
