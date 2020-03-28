<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\AppConst;

use App\Book;
//
class ApiBooksController extends Controller
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
	public function get_tasks()
	{   
//exit();
		$books = Book::orderBy('id', 'desc')
		->limit($this->TBL_LIMIT)
		->get();
		return response()->json($books);
	}
    /**************************************
     *
     **************************************/  
    public function create_book(Request $request){
		$inputs = $request->all();
		$inputs["radio_2"] = 0;
        $book = new Book();
		$book->fill($inputs);
        $book->save();
//		$ret = ['title' => request('title'),'content' => request('content')];
//        $ret = $request->all();		
        return response()->json($inputs);
	}
    /**************************************
     *
     **************************************/  
    public function get_item(Request $request)
    {
        $task = Book::find(request('id'));
        $ret = ['id'=> request('id') ];
        return response()->json($task );
    }	
    /**************************************
     *
     **************************************/
    public function update_post(Request $request){
		$inputs = $request->all();
		$book = Book::find(request('id'));
		$book->fill($inputs);
        $book->save();
//        $ret = ['id'=> request('id') , 'title' => request('title'),
//                'content' => request('content')];
        return response()->json($inputs);
	}
    /**************************************
     *
     **************************************/
    public function delete_task(Request $request){
        $book = Book::find(request('id'));
        $book->delete();
        $ret = ['id'=> request('id') ];
        return response()->json($ret);
    }	

}
