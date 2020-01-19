<?php
//タスク

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Task;
use Log;

//
class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $user = Auth::user();
        $user_id = Auth::id();
//var_dump( $user  );
//exit();        
    }
    /**************************************
     *
     **************************************/
    public function index()
    {
//var_dump("#index");
        $tasks = Task::orderBy('id', 'desc')->paginate(10 );
        return view('tasks/index')->with('tasks', $tasks);
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('tasks/create')->with('task', new Task());
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
    public function store(Request $request)
    {
        $inputs = $request->all();
        //validation
        $validation = $this->validator($inputs);
        if($validation->fails())
        {
// debug_dump($validation->errors());
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $task = new Task();
        $task->fill($inputs);
        $task->save();
        return redirect()->route('tasks.index');
    }
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks/show')->with('task', $task);
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks/edit')->with('task', $task);
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->fill($request->all());
        $task->save();
        return redirect()->route('tasks.index');
    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }  
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
