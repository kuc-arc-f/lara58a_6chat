<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // テーブルのクリア
        DB::table('tasks')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $tasks = [
            [
                'title' => 'PHP Book-1',
                'content' => 'PHPER'
            ],
            [
                'title' => 'PHP Book-2',
                'content' => 'PHPER-2'
            ],
            [
                'title' => 'PHP Book-3',
                'content' => 'PHPER-3'
            ],
            [
                'title' => 'PHP Book-4',
                'content' => 'PHPER'
            ], 
            [
                'title' => 'PHP Book-5',
                'content' => 'PHPER'
            ],                       
        ];

        // 登録
        foreach($tasks as $task ) {
            \App\Task::create($task);
        }
    }

}
