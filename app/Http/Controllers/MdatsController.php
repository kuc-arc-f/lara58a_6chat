<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
//use App\Http\Controllers\Controller;
use App\Mdat;
use App\User;

use Carbon\Carbon;
//
class MdatsController extends Controller
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
        $user_id = Auth::id();
        $dt = new Carbon(self::getYm_firstday());
        $now_month= $dt->format('Y-m');
        $startDt = $dt->format('Y-m-d');
        $endDt = $dt->endOfMonth()->format('Y-m-d');
//dd($startDt);
        $mdats = Mdat::orderBy('date', 'asc')
        ->where("user_id", $user_id )
        ->whereBetween("date", [$startDt, $endDt ])
        ->paginate(31 );
        $prev = $this->getPrev();
        $next = $this->getNext();        
        return view('mdats/index')->with(
            compact('mdats', 'prev', 'next','now_month') 
        );
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
        $mdat = new Mdat();
        $mdat["date"] = $date;

        return view('mdats/create')->with('mdat', $mdat );
    }
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::id();
        if(empty($user_id)){
            session()->flash('flash_message', 'ユーザー情報の取得に失敗しました。');
            return redirect()->route('mdats.index');
        }     
        $data["user_id"] = $user_id;   
//dd($data );
        $mdat = new Mdat();
        $mdat->fill($data );
        $mdat->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('mdats.index');
    }  
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $mdat = Mdat::find($id);
        return view('mdats/edit')->with('mdat', $mdat );
    }    
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $mdat = Mdat::find($id);
        $mdat->fill($request->all());
        $mdat->save();
        session()->flash('flash_message', '保存が完了しました');
        return redirect()->route('mdats.index');
    }   
    /**************************************
     *
     **************************************/
    public function chart()
    {
        $user_id = Auth::id();
        $dt = new Carbon(self::getYm_firstday());
        $now_month= $dt->format('Y-m');
        $startDt = $dt->format('Y-m-d');
        $endDt = $dt->endOfMonth()->format('Y-m-d');

        $mdats = Mdat::orderBy('date', 'asc')
        ->where("user_id", $user_id )
        ->whereBetween("date", [$startDt, $endDt ])
        ->get();
//dd($mdats->toArray() );
//exit();
        return view('mdats/chart')->with('mdats', $mdats );        
    }
    /**************************************
     *
     **************************************/
    public function csv_get(){
        $user_id = Auth::id();
        $dt = new Carbon(self::getYm_firstday());
        $now_month= $dt->format('Y-m');
        $startDt = $dt->format('Y-m-d');
        $endDt = $dt->endOfMonth()->format('Y-m-d');
//dd($startDt);
//exit                
        $mdats = Mdat::orderBy('date', 'asc')
        ->where("user_id", $user_id )
        ->whereBetween("date", [$startDt, $endDt ])
        ->get(['date', 'hnum', 'lnum'] )->toArray();
//debug_dump($mdats );
//exit();
        $csvHeader = ['date', 'Height' , 'Low'];
        array_unshift($mdats, $csvHeader);   
        $stream = fopen('php://temp', 'r+b');
        foreach ($mdats as $mdat ) {
            fputcsv($stream, $mdat );
        }
        rewind($stream);
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
        return response($csv )
            ->withHeaders([
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="mdat.csv"',
            ]);

    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
        $mdat = Mdat::find($id);
        $mdat->delete();
        return redirect()->route('mdats.index');
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
    /**************************************
     *
     **************************************/
    private function validator(array $items)
    {
        $i = 2;
        $errors = [];
        foreach ($items as $item ) {
//debug_dump("H=" . $hnum . ", i= ". $i);
            if(!empty($item[0])){
                $date = $item[0];
                $hnum = $item[1];
                $lnum = $item[2];
                if(empty($hnum)){
                    $errors[] = $i . "行目のHight が空白です";
                }
                if(empty($lnum )){
                    $errors[] = $i . "行目のLow が空白です";
                }
                if( !is_numeric($hnum)){
                    $errors[] = $i . "行目のHight は数値を入力下さい";
                }
                if( !is_numeric($lnum)){
                    $errors[] = $i . "行目のLow は数値を入力下さい";
                }
            }
            $i = $i +1;
        }
        return $errors;
    }
    /**************************************
     *
     **************************************/
    public function csv_import(Request $request){
        $user_id = Auth::id();
        // CSVファイルをサーバーに保存
        $temporary_csv_file = $request->file('csv_file')->store('csv');
        $fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');
        // 一行目（ヘッダ）読み込み
        $headers = fgetcsv($fp);

        $column_names = [];
        // CSVヘッダ確認
        foreach ($headers as $header) {
            $result = Mdat::retrieveTestColumnsByValue($header, 'SJIS-win');
            if ($result === null) {
                fclose($fp);
                Storage::delete($temporary_csv_file);
                session()->flash('flash_message', '登録に失敗しました。CSVファイルのフォーマットが正しいことを確認してださい。');
                return redirect()->route('mdats.index');
            }
            $column_names[] = $result;
        }
        $csv_items = [];
        while ($row = fgetcsv($fp)) {
            mb_convert_variables('UTF-8', 'SJIS-win', $row);
            $csv_items[] = $row;
        }
        fclose($fp);
//debug_dump( $csv_items );
        $errors = $this->validator($csv_items );
        if(count($errors) > 0 ){
            return redirect()->back()->withErrors($errors)->withInput();
        }

        foreach ($csv_items as $row) {
            $date  =$row[0];
            if(!empty($date)){
                $mdat = Mdat::where('user_id', $user_id )
                ->where('date', $date )->first();
                if(empty($mdat) ){
                    $mdat = new Mdat();
                    $data["date"] = $row[0];
                    $data["hnum"] = $row[1];
                    $data["lnum"] = $row[2];
                    $data["user_id"] = $user_id;
                    $mdat->fill($data );
                    $mdat->save();
                }else{
                    $mdatArray = $mdat->toArray();
                    $mdat = Mdat::find($mdatArray["id"]);
                    $data["date"] = $row[0];
                    $data["hnum"] = $row[1];
                    $data["lnum"] = $row[2];
                    $mdat->fill($data );
                    $mdat->save();
                }    
            }
        }
        return redirect()->route('mdats.index');
    }

    /**************************************
     *
     **************************************/   
    public function test1(Request $request){
//dd("test1");
        $nowdate = Date("Ymd");
        $directory = storage_path('app/csv/');
        var_dump($nowdate );
        dd($directory );
        //        $files = Storage::files($directory);
        //        $files = Storage::files("local");
        $files = Storage::allFiles("local");
        dd($files );
exit();
    }


}
