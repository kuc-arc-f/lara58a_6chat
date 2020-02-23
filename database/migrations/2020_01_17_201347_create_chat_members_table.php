<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chat_id')->nullable(false);
            $table->bigInteger('user_id')->nullable(false);
            $table->text('token')->nullable()->comment('送信先トークン');          
            $table->timestamps();
        });
        // ALTER TABLE chat_members COMMENT 'チャットのメンバー'
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_members');
    }
}
