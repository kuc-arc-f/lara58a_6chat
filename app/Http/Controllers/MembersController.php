<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dept;
use App\Member;

//
class MembersController extends Controller
{
    //
    /**************************************
     *
     **************************************/
    public function index()
    {
        $members = Member::select([
                    'members.id',
                    'members.dept_id',
                    'members.name',
                    'depts.name as dept_name',
                ])
                ->join('depts','depts.id','=','members.dept_id')
                ->paginate(5);
        //->get();
        // ->join('depts','depts.id','=','members.dept_id')
        // ->leftJoin()
    foreach ($members as $member ){
//var_dump($member->id);
    }
//debug_dump($members->toArray() );
//exit();
//        $members = Member::orderBy('updated_at', 'desc')->paginate(5);
        return view('members/index')->with('members', $members);
    }      

    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('members/create')->with('member', new Member());
    }
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $inputs = $request->all();
        $member = new Member();
        $member->fill($inputs);
        $member->save();
        return redirect()->route('members.index');
    }    

}
