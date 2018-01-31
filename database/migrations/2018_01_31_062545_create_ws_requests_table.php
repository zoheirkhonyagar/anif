<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWsRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interfaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->unsignedInteger('count_user')->default(0);
            $table->string('token')->unique();
            $table->double('version_number', 8, 8)->default(0.192);
            $table->text('explain')->nullable();
        });


        Schema::create('day_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->unsignedInteger('count_use')->default(0);
            $table->string('start', 5)->default('00:00');
            $table->string('end', 5)->default('00:00');
            $table->text('explain')->nullable();
        });

        Schema::create('anif_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 90);
            $table->string('method_name', 60);
            $table->unsignedInteger('count')->default(0);
            $table->text('explain')->nullable();
        });

        Schema::create('ws_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unique_code');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('interface_id')->default(1);
            $table->unsignedInteger('day_section_id');
            $table->unsignedInteger('position_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('interface_id')->references('id')->on('interfaces');
            $table->foreign('day_section_id')->references('id')->on('day_sections');
            $table->foreign('position_id')->references('id')->on('anif_positions');
            $table->unsignedInteger('count')->default(0);
            $table->date('date');
            $table->unique(['unique_code', 'interface_id','day_section_id','position_id', 'date'], 'u-i-day-p-date');
            $table->boolean('is_register')->default(false);
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
        Schema::dropIfExists('ws_requests');
        Schema::dropIfExists('day_sections');
        Schema::dropIfExists('interfaces');
        Schema::dropIfExists('anif_positions');

    }
}
