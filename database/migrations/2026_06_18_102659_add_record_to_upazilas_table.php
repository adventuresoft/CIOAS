<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('upazilas', function (Blueprint $table) {
            $table->string('record')->nullable()->after('district_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upazilas', function (Blueprint $table) {
            $table->dropColumn('record');
        });
    }
};
