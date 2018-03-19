<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewInfoStoresCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('instagram', 110)->after('menu_link')->nullable();
            $table->string('telegram', 110)->after('instagram')->nullable();
            $table->unsignedInteger('visit_count')->after('rank')->default(0);
            $table->integer('crm_TM')->after('member_count')->default(0);
            $table->string('message_join_crm', 110)->after('member_count')->nullable();
            $table->boolean('is_active')->after('is_online_order')->default(1);
        });


        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('is_active')->after('all_TM')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
