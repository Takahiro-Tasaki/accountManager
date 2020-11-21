<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login', function (Blueprint $table) {
          $table->unsignedInteger('user_id');
          $table->string('mail', 128);
          $table->string('password', 256);
          $table->timestamp('create_date')->useCurrent();
          $table->timestamp('update_date')->useCurrent();
          
          $table->primary('user_id');
          $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login');
    }
}
