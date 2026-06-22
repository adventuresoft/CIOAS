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
        Schema::table('lands', function (Blueprint $table) {
            $table->unsignedBigInteger('record_type')->nullable()->after('land_type');
            $table->unsignedBigInteger('district_id')->nullable()->after('record_type');
            $table->unsignedBigInteger('upazila_id')->nullable()->after('district_id');
            $table->unsignedBigInteger('mouza_id')->nullable()->after('upazila_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->dropColumn(['record_type', 'district_id', 'upazila_id', 'mouza_id']);
        });
    }
};
