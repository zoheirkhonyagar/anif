<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
            $table->string('fa_name',60);
            $table->string('bot_username',120)->nullable();
            $table->string('admin_bot_username',120)->nullable();
            $table->string('user_bot_token',191)->nullable();
            $table->string('admin_bot_token',191)->nullable();

            $table->timestamps();
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->decimal('lat',10 , 8)->nullable();
            $table->decimal('lng',10 , 8)->nullable();
            $table->timestamps();
        });


        Schema::create('store_regions', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('region_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unique(['city_id', 'region_id']);
            $table->boolean('is_free_delivery')->default(1);
            $table->integer('delivery_cost')->default(0);
            $table->integer('delivery_time')->default(0);
            $table->timestamps();
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->unsignedInteger('city_id')->after('name')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_regions');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('cities');
    }
}
