<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableColToHotelRestaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_restaurants', function (Blueprint $table) {

            $table->string('application_id')->unique();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('post_office_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('house_bn')->nullable();
            $table->string('house')->nullable();

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
            //
        });
    }
}