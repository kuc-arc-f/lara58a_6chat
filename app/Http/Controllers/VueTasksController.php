<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Task;
//
class VueTasksController extends Controller
{
    
    /**************************************
     *
     **************************************/
    public function index()
    {
//var_dump("#index");
        $tasks = Task::orderBy('id', 'desc')->paginate(10 );
        return view('vue/tasks/index')->with('tasks', $tasks);
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('vue/tasks/create')->with('task', new Task());
    }
    /**************************************
     * 入力値の検証
     **************************************/    
    private function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
        ]);
    }
    /**************************************
     *
     **************************************/    
    /*
    public function store(Request $request)
    {
        $inputs = $request->all();
        $validation = $this->validator($inputs);
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $task = new Task();
        $task->fill($inputs);
        $task->save();
        return redirect()->route('tasks.index');
    }
    */
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $task = Task::find($id);
        return view('vue/tasks/show')->with('task_id', $id );
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $task = Task::find($id);
        return view('vue/tasks/edit')->with('task_id', $id);
    }
    /*
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->fill($request->all());
        $task->save();
        return redirect()->route('tasks.index');
    }
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }  
    */
    /**************************************
     *
     **************************************/
    public function data1(){
        for($i = 1; $i <= 100; $i++){
            $data = array(
                'title' => "title-" . $i,
                "content" => "content-" . $i,
            );
            $task = new Task();
            $task->fill($data );
            $task->save();
        }
//debug_dump($data);
exit();
    }     
}
