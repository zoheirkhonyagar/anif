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
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->unsignedInteger('anif_code')->unique()->nullable();
            $table->string('user_name', 50)->unique()->nullable();
            $table->timestamp('birthday')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('TM')->default(0);
            $table->unsignedInteger('all_TM')->default(0);
            $table->unsignedTinyInteger('type')->default(0);
            $table->text('image')->nullable();
            $table->rememberToken();
            $table->string('api_token')->unique();
            $table->timestamps();
        });

        Schema::create('tmp_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number', 11)->unique();
            $table->integer('code')->unsigned();
            $table->timestamps();
        });

        Schema::create('tmp_register', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number', 11)->unique();
            $table->integer('code')->unsigned();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('tmp_register');
        Schema::dropIfExists('tmp_registers');
    }
}
