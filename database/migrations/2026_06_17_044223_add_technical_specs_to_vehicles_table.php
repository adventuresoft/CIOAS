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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('engine_number')->nullable()->after('vehicle_model');
            $table->string('chassis_number')->nullable()->after('engine_number');
            $table->string('tyre_number')->nullable()->after('chassis_number');
            $table->string('hp_cc')->nullable()->after('tyre_number');
            $table->string('seat_capacity')->nullable()->after('hp_cc');
            $table->string('height')->nullable()->after('seat_capacity');
            $table->string('width')->nullable()->after('height');
            $table->string('tyre_size')->nullable()->after('width');
            $table->string('color')->nullable()->after('tyre_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'engine_number',
                'chassis_number',
                'tyre_number',
                'hp_cc',
                'seat_capacity',
                'height',
                'width',
                'tyre_size',
                'color',
            ]);
        });
    }
};
