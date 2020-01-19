<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dept;
use App\Member;

//
class DeptsController extends Controller
{
    /**************************************
     *
     **************************************/
    public function index()
    {
/*
        $depts = Dept::select([
            'depts.id',
            'depts.name',
            'members.name as member_name',
            'members.id as member_id',
        ])
        ->join('members', 'members.dept_id' ,'=', 'depts.id')
        ->paginate(5);
*/
        $depts = Dept::orderBy('updated_at', 'desc')->paginate(5);
        return view('depts/index')->with('depts', $depts );
    }

    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('depts/create')->with('dept', new Dept());
    }
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $inputs = $request->all();
        DB::beginTransaction();
        try {
            $dept = new Dept();
            $dept->fill($inputs);
            $result = $dept->save();
//debug_dump($dept->id );
            if($result && isset($inputs["member"]) ){
                $this->save_members($inputs["member"], $dept->id);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }        
        return redirect()->route('depts.index');
    }    
    /**************************************
     *
     **************************************/ 
    private function save_members($members, $dept_id){
        //insert
        foreach ($members as $member){
            if(empty($member) == false){
                $data= [
                    "dept_id" => $dept_id,
                    "name" => $member,
                    "mail" => "",
                ];
                $member = new Member();
                $member->fill($data );
                $member->save();                
            }
        }
    }
    /**************************************
     *
     **************************************/     
    public function show($id)
    {
        $dept = Dept::find($id);
        //member
        $members = Member::where('dept_id', $id)
        ->orderBy('id', 'ASC')
        ->get();

        return view('depts/show')->with(compact('dept', 'members'));
    }
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $dept = Dept::find($id);
        //member
        $members = Member::where('dept_id', $id)
        ->orderBy('id', 'ASC')
        ->get(); 

        return view('depts/edit')->with(compact('dept', 'members'));
        
    }   
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        DB::beginTransaction();
        try {
            $dept = Dept::find($id);
            $dept->fill($inputs);
            $result = $dept->save();
            if($result && isset($inputs["member"]) ){
                $this->delete_members($id);
                $this->save_members($inputs["member"], $dept->id);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }        
        return redirect()->route('depts.index');
    }
    /**************************************
     *
     **************************************/    
    private function delete_members($id){
        $delete_items = [];
        $members = Member::where('dept_id', $id)->get(); 
        foreach ($members as $member){
            $delete_items[] = $member->id;
        }
        Member::destroy( $delete_items );
    }

}
