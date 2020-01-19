<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use App\Task;
//
class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test, Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
//        $this->test_add_tasks();
//var_dump("#test-complete");
    }

    /**************************************
     *
     **************************************/
    private function test_add_tasks(){
        for($i = 1; $i <= 10; $i++){
            $data = array(
                'title' => "title-1216-" . $i,
                "content" => "content-" . $i,
            );
            $task = new Task();
            $task->fill($data );
            $task->save();
        }
    }
     
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
