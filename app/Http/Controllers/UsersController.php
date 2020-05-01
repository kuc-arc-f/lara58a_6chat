<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\GoogleUser;
//
use App\Libs\AppConst;
//
class UsersController extends Controller
{
	/**************************************
	 *
	 **************************************/	
	public function __construct()
	{
//		$this->middleware('auth');
	}		
	/**************************************
	 *
	 **************************************/
	public function index(){
var_dump("#index");
exit();
	}
	/**************************************
	 * valid google auth
	 **************************************/
	public function valid_go(){
//var_dump("#valid_google");
		$user = null;
		$SUPER_USER_MAIL = env('SUPER_USER_MAIL', '');
//		return view('users/valid_go')->with('user', $user );
		return view('users/valid_go')->with(compact('user', 'SUPER_USER_MAIL'));
	}	
	/**************************************
	 *
	 **************************************/
	public function next_auth(Request $request){
		$email = 0;
		return view('users/next_auth')->with('user', $email );
	}
	/**************************************
	 * API, get user
	 **************************************/	
	public function get_user(Request $request){
		$const = new AppConst;
		$ret = $request;
		$valid =$this->valid_mail_login( $request["email"] );
		if($valid){
			$retArr = [
				"user" => null,
				"request" => $request->all(),
				"ret_empty" => 0,
				"return" => 0,
				"error_message" => "this mail user already add, sorry.",
			];
			return response()->json($retArr );			
			exit();
		}
		$user = User::where('email', $request["email"])
		->first();
// var_dump($user );
		$ret_empty= empty($user);
		if(empty($user)){
			$data["name"] = $request["displayName"];
			$data["email"] = $request["email"];
			$data["password"] = Hash::make( $const->google_user_pass );
			$user = new User();
			$user->fill($data );
			$user->save();
			//go-user
			$data_go = [];
			$data_go["name"] = $request["displayName"];
			$data_go["email"] = $request["email"];
			$data_go["google_uid"] = $request["uid"];
			$google_user = new GoogleUser();
			$google_user->fill($data_go );
			$google_user->save();
		}
		$retArr = [
			"user" => $user,
			"request" => $request->all(),
			"ret_empty" => $ret_empty,
			"return" => 1,
			"error_message" => "",
		];
		return response()->json($retArr );
	}
	/**************************************
	 * メール認証ユーザ検証, true=メール認証  ,false=メール認証以外
	 **************************************/
	private function valid_mail_login($email ){
		$ret = false;

		$valid_user = false;
		$valid_google = false;
		$user = User::where('email', $email )
		->first();
		if(!empty($user)){
			$valid_user = true;
		}
		$google_user = GoogleUser::where('email', $email )
		->first();
		if(!empty($google_user )){
			$valid_google = true;
		}		
//debug_dump($valid_user);
//debug_dump($valid_google);
		if($valid_user== true  && $valid_google== false){
				$ret = true;
		}
		return $ret;
	}
	/**************************************
	 *
	 **************************************/
	public function test(){
		$v =$this->valid_mail_login("aa@gmail.com");
var_dump($v );
exit();
		$user = User::where('email', 'aaa@gmail.com' )
		->get();
		$user = $user->toArray();
//var_dump( empty($user) );
		$user = null;
		return view('users/test')->with('user', $user );
	}	

}
