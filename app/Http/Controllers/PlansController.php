<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Plan;
use App\User;
use App\Libs\AppConst;

use Carbon\Carbon;
//
class PlansController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }    
    /**************************************
     *
     **************************************/
    public function index(Request $request)
    {   
//        $user_id = Auth::id();
        $const = new AppConst;
        $user_id  = $this->get_guestUserId( $const->guest_user_mail );

        $dt = new Carbon(self::getYm_firstday());
        $startDt = $dt->format('Y-m-d');
        $now_month= $dt->format('Y-m');
        $endDt = $dt->endOfMonth()->format('Y-m-d');
        $plans = Plan::where('user_id', $user_id)
        ->whereBetween("date", [$startDt, $endDt ])
        ->get(); 
        
        $month = $this->getMonth();
        $weeks = $this->getWeekItems();
        $weeks = $this->convert_plans($weeks , $plans);
//dd($weeks );
//exit();
        $prev = $this->getPrev();
        $next = $this->getNext();
        return view('plans/index')->with(compact(
            'weeks','prev','next','month','now_month'
         ));
    }
    /**************************************
     *
     **************************************/
    public function create()
    {
        $date = "";
        if(isset($_GET['ymd'])){
            $date = $_GET['ymd'];
        }else{
            $date = Carbon::now()->format('Y-m-d');
        }
//debug_dump( $date );
        $plan = new Plan();
        $plan["date"] = $date;
        return view('plans/create')->with('plan', $plan );
    }    
    /**************************************
     *
     **************************************/    
    private function get_planDateExist($date, $user_id){
        $plan = Plan::where('date', $date)
        ->where("user_id", $user_id )
        ->get();
        return $plan->toArray();
    }
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $user = Auth::user();
//        $user_id = Auth::id();
        $const = new AppConst;
        $user_id  = $this->get_guestUserId( $const->guest_user_mail );        
        if(empty($user_id)){
            session()->flash('flash_message', 'ユーザー情報の取得に失敗しました。');
            return redirect()->route('plans.index');
        }
        $inputs = $request->all();
        $inputs["user_id"] = $user_id;
        //valid
        $checkPlan = $this->get_planDateExist($inputs["date"], $user_id);
//debug_dump($inputs );
        if(!empty($checkPlan)){
            $errors =[];
            $errors[] = $inputs["date"]. "は登録済です。";
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $todo = new Plan();
        $todo->fill($inputs);
        $todo->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('plans.index');
    }    
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $plan = Plan::find($id);
//var_dump($plan );
//exit();
        return view('plans/show')->with('plan', $plan );
    }    
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('plans/edit')->with('plan', $plan );
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $data = $request->all();
//debug_dump($data );
        $task = Plan::find($id);
        $task->fill($data);
        $task->save();
        return redirect()->route('plans.index');
    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $plan = Plan::find($id);
        $plan->delete();
        return redirect()->route('plans.index');
    }
     /**************************************
     *
     **************************************/
    private function convert_plans($weeks , $plans){
        $newWeeks = [];
        $weekItem = [];
        foreach ($weeks as $days){
            $weekItem = [];
            foreach ($days as $day){
                if(!empty($day["day"])){
                    $dt = new Carbon(self::getYm() . '-' . $day["day"]);
                    $date = $dt->format('Y-m-d');
                    $planArr = $this->get_planContent($date , $plans);
                    $day["content"] = $planArr["content"];
                    $day["id"] = $planArr["id"];
//debug_dump($date );
                }
                $weekItem[] = $day;
            }
            $newWeeks[] = $weekItem;
        }
        return $newWeeks;
    }
    /**************************************
     *
     **************************************/
    private function get_planContent($date , $plans){
        $ret = ["content" => "", "id" => NULL ];
        foreach ($plans as $plan){
            if($plan["date"] == $date){
                $ret["content"] = $plan["content"];
                $ret["id"] = $plan["id"];
            }
        }
        return $ret;
    }
    /**************************************
     *
     **************************************/
    private function getWeekItems(){
        $weeks = [];
        $weekItem = [];

        $dt = new Carbon(self::getYm_firstday());
        $day_of_week = $dt->dayOfWeek;
        $days_in_month = $dt->daysInMonth;
        $dayArray = array(
            "day" => null, 
            "today" => false,
            "content" => "",
        );
        $dayItem = $dayArray;
        for($i =0; $i < $day_of_week ;$i++ ){ $weekItem[] = $dayItem; }

        for ($day = 1; $day <= $days_in_month; $day++, $day_of_week++) {
            $dayItem = $dayArray;
            $date = self::getYm() . '-' . $day;
            $dt = new Carbon($date);
            $tmpDate = $dt->format('Y-m-d');
//debug_dump($tmpDate );
            $dayItem["day"] = $day;
            $dayItem["date"] = $tmpDate;
            if (Carbon::now()->format('Y-m-j') === $date) {
                $dayItem["today"] = true;
                $weekItem[] = $dayItem;
            } else {
                $weekItem[] = $dayItem;
            }
            if (($day_of_week % 7 === 6) || ($day === $days_in_month)) {
                if ($day === $days_in_month) {
                    $dayItem = $dayArray;
                    $dayItem["day"] ="";
                    $dayItem["today"] = false;
//                    $dayItem["date"] = null;
                    $num =6 - ($day_of_week % 7);
                    for($i =0; $i < $num ;$i++ ){ 
                        $weekItem[] = $dayItem; 
                    }

                }
                $weeks[] = $weekItem;
                $weekItem = [];
            }
        }
        return $weeks;
    }    

    /**
     * month 文字列を返却する
     *
     * @return string
     */
    public function getMonth()
    {
        return Carbon::parse(self::getYm_firstday())->format('Y年n月');
    }
    /**
     * prev 文字列を返却する
     *
     * @return string
     */
    public function getPrev()
    {
        return Carbon::parse(self::getYm_firstday())->subMonthsNoOverflow()->format('Y-m');
    }
    /**
     * next 文字列を返却する
     *
     * @return string
     */
    public function getNext()
    {
        return Carbon::parse(self::getYm_firstday())->addMonthNoOverflow()->format('Y-m');
    }
    /**
     * GET から Y-m フォーマットを返却する
     *
     * @return string
     */
    private static function getYm()
    {
        if (isset($_GET['ym'])) {
            return $_GET['ym'];
        }
        return Carbon::now()->format('Y-m');
    }
    /**
     * YYYY-MM-DD 書式の取得
     *
     * @return string
     */
    private static function getYm_firstday()
    {
        return self::getYm() . '-01';
    }    



}
