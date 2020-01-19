<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//
class Mdat extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'user_id',
        'date',
        'hnum',
        'lnum',
    ];

    /**
     * CSVヘッダ項目の定義値があれば定義配列のkeyを返す   
     *
     * @param string $header
     * @param string $encoding
     * @return string|null
     */
    public static function retrieveTestColumnsByValue(string $header ,string $encoding)
    {
        // CSVヘッダとテーブルのカラムを関連付けておく
        $list = [
//            'content' => "内容",
//            'memo'    => "備考",
            'date' => "date",
            'Height'    => "Height",
            'Low'    => "Low",
        ];


        foreach ($list as $key => $value) {
            if ($header === mb_convert_encoding($value, $encoding)) {
                return $key;
            }
        }
        return null;
    }


}
