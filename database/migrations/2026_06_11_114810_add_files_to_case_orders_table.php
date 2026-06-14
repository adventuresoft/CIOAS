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
        Schema::table('case_orders', function (Blueprint $table) {
            $table->longText('files')->nullable()->after('command_no_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_orders', function (Blueprint $table) {
            $table->dropColumn('files');
        });
    }
};
