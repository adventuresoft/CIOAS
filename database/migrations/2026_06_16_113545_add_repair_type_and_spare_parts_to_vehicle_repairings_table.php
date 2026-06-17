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
        Schema::table('vehicle_repairings', function (Blueprint $table) {
            $table->string('repair_type')->nullable()->after('workshop_name');
            $table->string('spare_parts')->nullable()->after('repair_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_repairings', function (Blueprint $table) {
            $table->dropColumn(['repair_type', 'spare_parts']);
        });
    }
};
