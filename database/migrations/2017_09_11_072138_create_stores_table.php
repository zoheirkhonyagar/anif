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
            $table->text('working_hours');
            $table->text('features')->nullable();
            $table->unsignedInteger('s_category_id');
            $table->text('menu_link')->nullable();
            $table->timestamp('delivery_time');
            $table->unsignedInteger('delivery_cost')->default(0);
            $table->boolean('is_online_order')->default(true);
            $table->boolean('is_table_reservation')->default(false);
            $table->decimal('latitude',10 , 8);
            $table->decimal('longitude',10 , 8);
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
        Schema::dropIfExists('stores');
    }
}
