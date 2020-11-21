<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kind', function (Blueprint $table) {
          $table->increments('kind_id');
          $table->string('name', 40);
          $table->string('kana', 100);
          $table->timestamp('create_date')->useCurrent();
          $table->timestamp('update_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kind');
    }
}
