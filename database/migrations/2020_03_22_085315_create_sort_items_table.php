<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sort_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_no')->nullable(false);
            $table->string('title')->nullable(false);
            $table->text('content')->nullable();            
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
        Schema::dropIfExists('sort_items');
    }
}
