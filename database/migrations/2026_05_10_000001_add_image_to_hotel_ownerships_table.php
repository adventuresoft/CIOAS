<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToHotelOwnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_ownerships', function (Blueprint $table) {
            if (!Schema::hasColumn('hotel_ownerships', 'image')) {
                $table->string('image')->nullable()->after('present_house_bn');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_ownerships', function (Blueprint $table) {
            if (Schema::hasColumn('hotel_ownerships', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
}
