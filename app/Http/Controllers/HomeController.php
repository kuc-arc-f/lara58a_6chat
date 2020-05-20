<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Message;
use App\User;
//
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**************************************
	*
	 **************************************/
    public function index()
    {
        $message_display_mode = true;
        $user = Auth::user();
        $user_id = Auth::id();
        //messages
        $messages = $this->get_message_items($user_id );
//debug_dump( $messages );
//exit();
        return view('home')->with(compact(
            'user', 'messages', 'message_display_mode'
        ));
    }
    
}
