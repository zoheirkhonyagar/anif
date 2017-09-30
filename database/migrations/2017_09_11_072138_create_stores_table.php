<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();
        });


        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('username', 120);
            $table->string('password', 255);
            $table->string('telephone_number', 11);
            $table->text('address');
            $table->float('rank')->nullable();
            $table->integer('member_count')->default(0);
            $table->string('explain')->nullable();
            $table->text('images')->nullable();
            $table->string('working_hours', 30);
            $table->unsignedInteger('s_category_id');
            $table->foreign('s_category_id')->references('id')->on('store_categories');
            $table->string('menu_link')->nullable();
            $table->unsignedInteger('delivery_time');
            $table->unsignedInteger('delivery_cost')->default(0);
            $table->boolean('is_online_order')->default(true);
            $table->boolean('is_table_reservation')->default(false);
            $table->decimal('latitude',10 , 8);
            $table->decimal('longitude',10 , 8);
            $table->unsignedTinyInteger('sort_weight')->default(0);
            $table->timestamps();
        });

//        Schema::table('stores', function($table) {

//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
        Schema::dropIfExists('store_categories');
    }
}
