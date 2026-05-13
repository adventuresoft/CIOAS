<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_restaurants', function (Blueprint $table) {
            $table->unsignedBigInteger('union_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('pos_id')->nullable();
            $table->unsignedBigInteger('office_union_id')->nullable();
            $table->unsignedBigInteger('office_city_id')->nullable();
            $table->unsignedBigInteger('office_pos_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_restaurants', function (Blueprint $table) {
            $table->dropColumn('union_id');
            $table->dropColumn('city_id');
            $table->dropColumn('pos_id');
            $table->dropColumn('office_union_id');
            $table->dropColumn('office_city_id');
            $table->dropColumn('office_pos_id');
        });
    }
}
