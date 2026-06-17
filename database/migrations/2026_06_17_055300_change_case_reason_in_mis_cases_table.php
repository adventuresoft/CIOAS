<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mis_cases', function (Blueprint $table) {
            $table->string('case_reason', 255)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mis_cases', function (Blueprint $table) {
            $table->string('case_reason', 15, 2)->default(0)->change();
        });
    }
};
