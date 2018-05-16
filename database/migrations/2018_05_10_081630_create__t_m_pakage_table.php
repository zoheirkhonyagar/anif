<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMPakageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TM_package', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->integer('price');
            $table->integer('TM');
            $table->boolean('is_active')->default(1);
            $table->integer('off')->default(0);
            $table->unsignedInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk');
            $table->string('model', 80)->default('TM_package');
            $table->string('code',12)->unique();
            $table->integer('amount');
            $table->string('payment')->default('zarinpal');
            $table->TinyInteger('status')->defualt(0) ;
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('method_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('method_id')->references('id')->on('methods_tran_TM');
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
        Schema::dropIfExists('TM_package');
        Schema::dropIfExists('transactions');
    }
}
