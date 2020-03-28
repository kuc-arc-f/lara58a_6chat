<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libs\AppConst;

use App\Todo;
//
class ApiTodosController extends Controller
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
    public function index()
    {   
//exit();
        $todos = Todo::orderBy('id', 'desc')
        ->limit($this->TBL_LIMIT)
        ->get();
        return response()->json($todos);
    }    
    /**************************************
     *
     **************************************/    
    public function search(Request $request){
        $data = $request->all();
//return response()->json( $data  );        
        $todos = Todo::where("title", "like", "%" . $data["search_key"] . "%" )
        ->orderBy('id', 'desc')
        ->limit($this->TBL_LIMIT)
        ->get();
        return response()->json( $todos  );
    }
    /**************************************
     *
     **************************************/  
    public function create_todo(Request $request){
        $const = new AppConst;
        $user_id  = $this->get_guestUserId( $const->guest_user_mail );
//var_dump( $const->guest_user_mail);
        $inputs = $request->all();
        $inputs["complete"] = 0;
        $inputs["user_id"] = $user_id;
        $todo = new Todo();
        $todo->fill($inputs);
        $todo->save();
        $ret = ['title' => request('title'),'content' => request('content')];
        return response()->json($ret);
    }
    /**************************************
     *
     **************************************/  
    public function update_todo(Request $request){
        $const = new AppConst;
        $todo = Todo::find( request('id') );
        $todo->fill($request->all());
        $inputs = $request->all();
        $todo->save();
        $ret = ['id'=> request('id') , 'title' => request('title'),
                'content' => request('content')];
        return response()->json($ret);
    }
    /**************************************
     *
     **************************************/  
    public function delete_todo(Request $request){
        $task = Todo::find(request('id'));
        $task->delete();
        $ret = ['id'=> request('id') ];
        return response()->json($ret);
    }
    /**************************************
     *
     **************************************/
    public function get_item(Request $request)
    {
        $todo = Todo::find(request('id'));
        $ret = ['id'=> request('id') ];
        return response()->json($todo );
    }    
    /**************************************
     *
     **************************************/   
    public function test1(){
        /*
        $todos = Todo::where("title", "A")
        ->orderBy('id', 'desc')
        ->get();
debug_dump($todos);
        */
exit();
    } 

}
