<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number', 11)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->unsignedInteger('anif_code')->unique();
            $table->string('user_name', 50)->unique();
            $table->timestamp('birthday')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('TM')->default(0);
            $table->unsignedInteger('all_TM')->default(0);
            $table->unsignedTinyInteger('type')->default(0);
            $table->unsignedTinyInteger('image')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
