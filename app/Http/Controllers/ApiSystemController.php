<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\User;
use App\Todo;
use App\Plan;
use App\Task;
use App\Book;
use App\Chat;
use App\ChatMember;
use App\ChatPost;
use App\Dept;
use App\Member;
use App\Mdat;

class ApiSystemController extends Controller
{
    /**************************************
     *
     **************************************/
    public function __construct(){
        $this->TBL_LIMIT = 1000;
        $this->ADMIN_USER_MAIL = [
            1 => "hoge1@example.com",
            2 => "hoge2@example.com",
            3 => "hoge3@example.com",
        ];
        $this->SUPER_USER_MAIL = "hoge@example.com";
        //FCM
        $this->FCM_messagingSenderId = "";
        $this->FCM_PublicVapidKey = "";
        $this->FCM_SERVER_KEY = "";
    }
    /**************************************
     * １回/ 日　に、削除処理
     **************************************/    
    public function delete_db_day(Request $request){
        $ret = ["ret"=> 1 ];
        $data = $request->all();
//        var_dump($data["mail"]);
        $valid = $this->valid_admin_user($data["mail"]);
        if( $valid ==false){
            $ret = ["ret"=> 0];
        }else{
            $this->delete_todo();
            $this->delete_plan();
            $this->delete_tasks();
            //chat
            $this->delete_chat_posts();
            $this->delete_books();   
            $this->delete_depts();
            $this->delete_members();
            $this->delete_mdats(); 
            //file-delete
//            $this->delete_mdat_files(); 
        }
//exit();
        return response()->json( $ret );
    }
    /**************************************
     *
     **************************************/
    private function valid_admin_user($mail){
        $ret = false;
        if($mail == $this->SUPER_USER_MAIL){
            $ret = true;
        }
        return $ret;
    }
    /**************************************
     *
     **************************************/
    private function get_user_id($mail){
        $ret = "";
        $user = User::where("email", $mail )
        ->first();
        if(!empty($user)){
            $ret = $user["id"];
        }
        return $ret;
    }
    /**************************************
     *
     **************************************/
    private function delete_plan(){
        $plans = $this->get_delete_plans();
        foreach ($plans as $plan) {
//            var_dump($plan["id"]);    
            $plan = Plan::find($plan["id"]);
            $plan->delete();
        }
    }
    /**************************************
     * 対象planの、取得
     **************************************/
    private function get_delete_plans(){
        $plans = [];
        $user_id = $this->get_user_id($this->SUPER_USER_MAIL  );
        if(!empty($user_id)){
//            var_dump( "uid=". $user_id );
            $plans = Plan::where("user_id", "<>" , $user_id)
            ->get();    
            if(!empty($plans)){
                $plans= $plans->toArray();
            }
        }
        return $plans;
    }
    /**************************************
     * delete - todos
     **************************************/
     private function delete_todo(){
         $todos = $this->get_delete_todo();
         foreach ($todos as $item) {
 //            var_dump($plan["id"]);    
            $item = Todo::find($item["id"]);
            $item->delete();
         }         
     }  
    /**************************************
     *
     **************************************/
    private function get_delete_todo(){
        $todos = [];
        $user_id = $this->get_user_id($this->SUPER_USER_MAIL  );
        $todos = Todo::where("user_id", "<>" , $user_id)->get();;
        if(!empty($todos)){
            $todos= $todos->toArray();
//            var_dump($todos );
        }        
        return $todos;
    }  
    /**************************************
     * delete - Task
     **************************************/
    private function delete_tasks(){
        $tasks = $this->get_delete_tasks();
        foreach ($tasks as $item) {
//            var_dump($plan["id"]);    
           $item = Task::find($item["id"]);
           $item->delete();
        }         
    }       
    /**************************************
     *
     **************************************/
    private function get_delete_tasks(){
        $tasks = [];
        $tasks = Task::get();
        if(!empty($tasks)){
            $tasks = $tasks->toArray();
//            var_dump($todos );
        }        
        return $tasks;
    }
    /**************************************
     *
     **************************************/
    private function delete_chat_posts(){
        $posts = $this->get_chat_posts();
        foreach ($posts as $item) {
//var_dump($item);
            $item = ChatPost::find($item["id"]);
            $item->delete();
         }        
    } 
    /**************************************
     * delete - books
     **************************************/
    private function delete_books(){
        $books = $this->get_delete_books();
        foreach ($books as $item) {
            $item = Book::find($item["id"]);
            $item->delete();            
        }
    }    
    /**************************************
     *
     **************************************/
    private function get_delete_books(){
        $books = [];
        $books = Book::get();
        if(!empty($books)){
            $books = $books->toArray();
//var_dump($books );
        }        
        return $books;
    }
    /**************************************
     *
     **************************************/
    private function delete_depts(){
        $depts = $this->get_delete_depts();
        foreach ($depts as $item) {
            $item = Dept::find($item["id"]);
            $item->delete();            
        }
    } 
    /**************************************
     *
     **************************************/
    private function get_delete_depts(){
        $depts = [];
        $depts = Dept::get();
        if(!empty($depts )){
            $depts = $depts->toArray();
//var_dump($depts );
        }        
        return $depts;
    }       
    /**************************************
     *
     **************************************/
    private function delete_members(){
        $members = $this->get_delete_members();
        foreach ($members as $item) {
            $item = Member::find($item["id"]);
            $item->delete();            
        }
    }
    /**************************************
     *
     **************************************/
    private function get_delete_members(){
        $members = [];
        $members = Member::get();
        if(!empty($members )){
            $members = $members->toArray();
//var_dump($members );
        }        
        return $members;
    }
    /**************************************
     *
     **************************************/
    private function delete_mdats(){
        $mdats = $this->get_delete_mdats();
        foreach ($mdats as $item) {
            $item = Mdat::find($item["id"]);
            $item->delete();            
        }
    }
    /**************************************
     *
     **************************************/
    private function get_delete_mdats(){
        $mdats = [];
        $mdats = Mdat::get();
        if(!empty($mdats )){
            $mdats = $mdats->toArray();
//var_dump($mdats );
        }        
        return $mdats;
    }
    /**************************************
     *
     **************************************/
    private function get_chat_posts(){
        $posts = [];
        $posts = ChatPost::get();
        if(!empty($posts )){
            $posts = $posts->toArray();
//            var_dump($posts );
        }        
        return $posts;        
    }
    /**************************************
     *
     **************************************/
    public function get_fcm_init(Request $request){
        $data = $request->all();

        $valid = $this->valid_admin_user($data["mail"]);
        if( $valid ==false){
            $ret = [
                "ret"=> 0 ,
                "params" => null,
                "data" => $data,
            ];
            return response()->json( $ret );            
            exit();
        }

//var_dump($data);
        $params = [
            "FCM_messagingSenderId" => $this->FCM_messagingSenderId,
            "FCM_PublicVapidKey" => $this->FCM_PublicVapidKey,
            "FCM_SERVER_KEY" => $this->FCM_SERVER_KEY,
        ];
        $ret = [
            "ret"=> 1 ,
            "params" => $params,
            "data" => $data,
        ];
        return response()->json( $ret );
    }
    /**************************************
     * delete -mdats- files
     **************************************/   
    private function delete_mdat_files(){
        $nowdate = Date("Ymd");
        $directory = storage_path('app/csv/');
var_dump($nowdate );
var_dump($directory );
//        $files = Storage::files($directory);
//        $files = Storage::files("local");
        $files = Storage::allFiles("public");
var_dump($files );
        //exit();
//        $files = scandir($directory );
        foreach($files as $file ){
            $filename= $directory . "/" . $file;
var_dump($filename );
            $file_dt = date ("Ymd", filemtime($filename));
            if((int)$nowdate > (int)$file_dt ){
//                unlink($filename);
            }            
        }
    } 


}