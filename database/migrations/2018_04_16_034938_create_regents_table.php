<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 12) ;
            $table->unique('code');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('intro_point')->default(0);
            $table->integer('count_introduced')->default(0);
            $table->integer('comment_point')->default(0);
            $table->integer('full_info_p')->default(0);
            $table->integer('buy_point')->default(0);
            $table->integer('point')->default(0);
            $table->timestamps();
        });

        Schema::create('referred_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('regent_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('regent_id')->references('id')->on('regents');
            $table->integer('TM')->default(5000);
            $table->boolean('ok')->default(0);
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
        Schema::dropIfExists('referred_users');
        Schema::dropIfExists('regents');
    }
}
