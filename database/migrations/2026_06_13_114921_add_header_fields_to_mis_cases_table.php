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
        Schema::table('mis_cases', function (Blueprint $table) {
            $table->text('header_one')->nullable()->after('status');
            $table->text('header_two')->nullable()->after('header_one');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mis_cases', function (Blueprint $table) {
            $table->dropColumn(['header_one', 'header_two']);
        });
    }
};
