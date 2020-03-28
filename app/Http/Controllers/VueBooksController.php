<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\AppConst;

use App\Book;
//
class VueBooksController extends Controller
{
    /**************************************
     *
     **************************************/
    public function index()
    {
//var_dump("#index");
        $books = Book::orderBy('updated_at', 'desc')->paginate(5);
        return view('vue/books/index')->with('books', $books);
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        $select_items  = $this->get_select_items();
        $radio_items  = $this->get_radio_items();
//var_dump($select_items);
//exit();
        $book= new Book();
        return view('vue/books/create')->with(
            compact('book', 'select_items', 'radio_items') 
        );
    }    
    /**************************************
     *
     **************************************/    
    public function show($id)
    {
        $book = Book::find($id);
        return view('vue/books/show')->with('book_id', $id );
    }    
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $book = Book::find($id);
//debug_dump($book );
//exit();
        $select_items  = $this->get_select_items();
        $radio_items  = $this->get_radio_items();
        $book_id = $id;
        return view('vue/books/edit')->with(
            compact('book_id', 'select_items' ,'radio_items') 
        );
    }    
    /**************************************
	 *
	 **************************************/
	private function get_select_items(){
		$items =  array(
			0 => 'type-A', 1 => 'type-B',
		);
		return $items;
    }
    /**************************************
	 *
	 **************************************/
	private function get_radio_items(){
		$items =  array(
            1 => 'radio-1',
            2 => 'radio-2',
            3 => 'radio-3',
		);
		return $items;
    }    
    // 
    /*
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        if(empty($inputs["check_1"] )){
            $inputs["check_1"] = 0;
        }
        if(empty($inputs["check_2"] )){
            $inputs["check_2"] = 0;
        }
        $book = Book::find($id);
        $book->fill($inputs );
        $book->save();
        return redirect()->route('books.index');
    }    
    */


}
