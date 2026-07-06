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
        Schema::table('license_ownerships', function (Blueprint $table) {
            $table->string('permanent_location_type')->nullable()->after('permanent_post_office');
            $table->unsignedBigInteger('permanent_city_id')->nullable()->after('permanent_location_type');
            $table->unsignedBigInteger('permanent_pos_id')->nullable()->after('permanent_city_id');
            $table->unsignedBigInteger('permanent_union_id')->nullable()->after('permanent_pos_id');
            
            $table->string('present_location_type')->nullable()->after('present_post_office_id');
            $table->unsignedBigInteger('present_city_id')->nullable()->after('present_location_type');
            $table->unsignedBigInteger('present_pos_id')->nullable()->after('present_city_id');
            $table->unsignedBigInteger('present_union_id')->nullable()->after('present_pos_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('license_ownerships', function (Blueprint $table) {
            $table->dropColumn([
                'permanent_location_type',
                'permanent_city_id',
                'permanent_pos_id',
                'permanent_union_id',
                'present_location_type',
                'present_city_id',
                'present_pos_id',
                'present_union_id',
            ]);
        });
    }
};
