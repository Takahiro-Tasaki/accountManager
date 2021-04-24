<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersExTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_ex', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->text('image')->nullable();
            $table->unsignedTinyInteger('auth')->default(1);
            $table->timestamp('create_date')->useCurrent();
            $table->timestamp('update_date')->useCurrent();
            
            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_ex');
    }
}
