<?php

use Illuminate\Database\Seeder;

class MdatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
//        DB::table('mdats')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $items = [
            [
                'user_id' => 1,
                'date' => '2019-12-01',
                'hnum' => 130,
                'lnum' => 70,
            ],
            [
                'user_id' => 1,
                'date' => '2019-12-02',
                'hnum' => 130,
                'lnum' => 70,
            ],
            [
                'user_id' => 1,
                'date' => '2019-12-03',
                'hnum' => 130,
                'lnum' => 70,
            ],

        ];
        foreach($items as $item ) {
            \App\Mdat::create($item );
        }
    }

}
