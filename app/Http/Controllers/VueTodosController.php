<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Libs\AppConst;
use App\Todo;
//
class VueTodosController extends Controller
{
    /**************************************
     *
     **************************************/
    public function index(Request $request)
    {
//exit();
        return view('vue/todos/index')->with('todos', null );
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('vue/todos/create')->with('todo', new Todo());
    }    
    /**************************************
     *
     **************************************/
    public function show($id)
    {
		$task_id  = $id;
		$todo = Todo::find($id);
		$complete_items = $this->get_complete_items();
		$complete_str = $complete_items[$todo->complete];
		return view('vue/todos/show')->with(compact('task_id', 'complete_items', 'complete_str') );        
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
        $task_id  = $id;
        $todo = Todo::find($id);
        $complete_items = $this->get_complete_items();
//        return view('vue/todos/edit')->with(compact('todo', 'complete_items') );
        return view('vue/todos/edit')->with(compact('task_id', 'todo', 'complete_items') );
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
        return redirect()->route('vue_todos.index');
    }
    /**************************************
     *
     **************************************/
    public function delete(Request $request)
    {
        $data = $request->all();
//debug_dump($data["delete_id"]);
        $todo = Todo::find( $data["delete_id"] );
        $todo->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect()->route('vue_todos.index');
    }

}
