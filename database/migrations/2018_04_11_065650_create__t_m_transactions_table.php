<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('methods_tran_TM', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('TM_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->tinyInteger('type');
            $table->integer('amount');
            $table->integer('inventory');
            $table->unsignedInteger('manager_id')->nullable();
            $table->unsignedInteger('method_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('method_id')->references('id')->on('methods_tran_TM');
            $table->timestamps();
        });

        Schema::create('tm_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 20);
            $table->unique('code');
            $table->unsignedInteger('amount') ;
            $table->boolean('is_active')->defualt(1);
            $table->unsignedInteger('count_usable')->defualt(1);
            $table->string('description',150)->nullable();
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
        Schema::dropIfExists('TM_transactions');
        Schema::dropIfExists('methods_tran_TM');
        Schema::dropIfExists('tm_codes');
    }
}
