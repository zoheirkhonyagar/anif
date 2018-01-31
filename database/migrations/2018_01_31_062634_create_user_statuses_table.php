<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unique_code');
            $table->boolean('is_online')->default(1);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('interface_id')->default(1);
            $table->unsignedInteger('current_position_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('interface_id')->references('id')->on('interfaces');
            $table->foreign('current_position_id')->references('id')->on('anif_positions');
            $table->unique(['unique_code', 'interface_id'],'unique-code-interface');
            $table->unsignedInteger('count_request')->default(0);
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
        Schema::dropIfExists('user_statuses');
    }
}
