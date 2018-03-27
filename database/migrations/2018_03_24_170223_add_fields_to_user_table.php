<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('seller_token')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('btc_address')->nullable();
            $table->string('doge_address')->nullable();
            $table->string('ltc_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn('seller_token');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('company_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('btc_address');
            $table->dropColumn('doge_address');
            $table->dropColumn('ltc_address');
        });
    }
}
