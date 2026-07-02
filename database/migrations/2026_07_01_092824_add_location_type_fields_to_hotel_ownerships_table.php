<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hotel_ownerships', function (Blueprint $table) {
            $table->string('permanent_location_type')->nullable();
            $table->unsignedBigInteger('permanent_city_id')->nullable();
            $table->unsignedBigInteger('permanent_pos_id')->nullable();
            $table->unsignedBigInteger('permanent_union_id')->nullable();
            
            $table->string('present_location_type')->nullable();
            $table->unsignedBigInteger('present_city_id')->nullable();
            $table->unsignedBigInteger('present_pos_id')->nullable();
            $table->unsignedBigInteger('present_union_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_ownerships', function (Blueprint $table) {
            //
        });
    }
};
