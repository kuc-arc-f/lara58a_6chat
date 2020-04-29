<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\GoogleUser;
//
class MypageController extends Controller
{
	/**************************************
	 *
	 **************************************/	
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**************************************
	 *
	 **************************************/
	public function show($id)
	{
		$user = User::find($id);
		return view('mypage/show')->with('user', $user );
	}
	/**************************************
	 *
	 **************************************/
	public function edit($id)
	{
		$user = User::find($id);
//debug_dump($user );
		return view('mypage/edit')->with('user', $user );
	}	
	/**************************************
	 *
	 **************************************/    
	public function update(Request $request, $id)
	{
		$inputs = $request->all();
		$user_id = Auth::id();
//debug_dump($user_id );
//		$d = $this->valid_user($id);
		if($this->valid_user($id) == false){
			session()->flash('flash_message', '本人以外は更新できません。');
		}else{
			$user = User::find($id);
			$user->fill($inputs );
			$user->save();
		}
		return redirect()->route('home');
	}	
	/**************************************
	 *
	 **************************************/	
	private function valid_user($id){
		$ret = true;
		$user_id = Auth::id();
		if((int)$user_id != (int)$id){
			$ret = false;
		}
		return $ret;
	}
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
		$user = User::find($id);
		$google_user = GoogleUser::where('email', $user->email )
		->first() ;
		if(!empty($google_user)){
//debug_dump( $google_user );
			$google_user = GoogleUser::find($google_user->id);
			$google_user->delete();	
		}
		$user->delete();
		session()->flash('flash_message', 'Deleted user, completed');	
		return redirect()->route('login');
    } 	
	
}
