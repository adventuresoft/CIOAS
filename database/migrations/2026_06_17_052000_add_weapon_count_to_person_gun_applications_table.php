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
        Schema::table('person_gun_applications', function (Blueprint $table) {
            $table->integer('weapon_count')->default(1)->after('weapon_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('person_gun_applications', function (Blueprint $table) {
            $table->dropColumn('weapon_count');
        });
    }
};
