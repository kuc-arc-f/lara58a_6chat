<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SortItem;
//
class ApiSortItemsController extends Controller
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
    public function get_items()
    {   
//exit();
        $todos = SortItem::orderBy('order_no', 'asc')
        ->limit($this->TBL_LIMIT)
        ->get();
        return response()->json($todos);
    }	

}
