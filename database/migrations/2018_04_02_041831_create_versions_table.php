<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->double('version',8, 6);
            $table->unsignedInteger('count_use')->default(0);
            $table->boolean('is_recommend')->default(0);
            $table->boolean('is_forced')->default(0);
            $table->string('link', 191) ;
            $table->string('possibility',450)->nullable();
            $table->string('explain',250)->nullable();
            $table->unsignedInteger('interface_id');
            $table->foreign('interface_id')->references('id')->on('interfaces');
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
        Schema::dropIfExists('versions');
    }
}
