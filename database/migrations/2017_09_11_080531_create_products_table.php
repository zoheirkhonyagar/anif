<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('store_id');
            $table->string('name',100);
            $table->unsignedInteger('price');
            $table->unsignedInteger('off')->default(0);
            $table->unsignedInteger('TM')->default(0);
            $table->text('details')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedTinyInteger('product_types');
            $table->unsignedInteger('earn_per_sale')->default(0);
            $table->unsignedInteger('count')->default(0);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sell_count')->default(0);
            $table->float('rank',1,1)->nullable();
            $table->unsignedInteger('comment_count')->default(0);
            $table->text('images')->nullable();
            $table->unsignedInteger('view_count')->default(0);
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
        Schema::dropIfExists('products');
    }
}
