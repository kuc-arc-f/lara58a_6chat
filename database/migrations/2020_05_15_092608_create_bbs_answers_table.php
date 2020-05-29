<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBbsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbs_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->bigInteger('bbs_category_id')->nullable(false);
            $table->bigInteger('bbs_post_id')->nullable(false);
            $table->bigInteger('user_id')->nullable(false);
            $table->text('content')->nullable();
            $table->integer('status')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bbs_answers');
    }
}
