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
        $tables = ['person_gun_applications', 'org_gun_applications', 'other_org_gun_applications'];
        
        foreach ($tables as $table) {
            if (!Schema::hasColumn($table, 'institute_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->unsignedBigInteger('institute_id')->nullable()->after('id');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['person_gun_applications', 'org_gun_applications', 'other_org_gun_applications'];
        
        foreach ($tables as $table) {
            if (Schema::hasColumn($table, 'institute_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('institute_id');
                });
            }
        }
    }
};
