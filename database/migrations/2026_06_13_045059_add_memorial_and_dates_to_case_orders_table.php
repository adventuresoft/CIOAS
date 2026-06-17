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
            $table->string('memorial_no')->nullable()->after('status');
            $table->date('command_start_date')->nullable()->after('command_type');
            $table->date('command_till_date')->nullable()->after('command_start_date');
            $table->date('command_end_date')->nullable()->after('command_till_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_orders', function (Blueprint $table) {
            $table->dropColumn(['memorial_no', 'command_start_date', 'command_till_date', 'command_end_date']);
        });
    }
};
