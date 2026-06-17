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
        Schema::table('vehicle_routes', function (Blueprint $table) {
            $table->string('from_point')->nullable()->after('vehicle_id');
            $table->string('middle_point')->nullable()->after('from_point');
            $table->string('end_point')->nullable()->after('middle_point');

            $table->dropColumn(['from_place', 'to_place']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_routes', function (Blueprint $table) {
            $table->string('from_place')->nullable();
            $table->string('to_place')->nullable();
            
            $table->dropColumn(['from_point', 'middle_point', 'end_point']);
        });
    }
};
