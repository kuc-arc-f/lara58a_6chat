<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chat_id')->nullable(false);
            $table->bigInteger('user_id')->nullable(false);
            $table->text('title')->nullable()->comment('タイトル');
            $table->text('body')->nullable()->comment('メッセージ');
            $table->timestamps();
        });
        // ALTER TABLE chat_posts COMMENT 'チャットのメッセージ'
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_posts');
    }
}
