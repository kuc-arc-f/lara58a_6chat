<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SortItem;

//
class VueSortItemsController extends Controller
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
//var_dump("#index");
		$items = SortItem::orderBy('id', 'desc')->paginate(10 );
		return view('vue/sort_items/index')->with('items', $items );
	}	
	/**************************************
	 *
	 **************************************/
	public function create()
	{
		return view('vue/sort_items/create')->with('sort_item', new SortItem());
	}	
	/**************************************
	 *
	 **************************************/    
	public function store(Request $request)
	{
		$inputs = $request->all();
		$inputs["order_no"] = 1;
		$task = new SortItem();
		$task->fill($inputs);
		$task->save();
		return redirect()->route('vue_sort_items.index');
	}
	/**************************************
     *
     **************************************/
    public function update_number(Request $request )
    {
		$inputs = $request->all();
		$items = json_decode($inputs['json_items'] , true);
		foreach($items as $item){
			$sort_item = SortItem::find($item["id"]);
			$data["order_no"] = $item["order_no"];
			$sort_item->fill($data );
			$sort_item->save();
			//debug_dump("id=" . $sort_item["id"]);
		}
//exit();
		session()->flash('flash_message', '並び順の保存が完了しました');
        return redirect()->route('vue_sort_items.index');
    }

}
