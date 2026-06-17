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
        Schema::table('case_orders', function (Blueprint $table) {
            $table->string('command_yes_note')->nullable()->after('command_text');
            $table->string('command_yes_file')->nullable()->after('command_yes_note');
            $table->string('command_no_file')->nullable()->after('command_yes_file');
            $table->integer('hearing_no')->default(1)->after('side_note');
            $table->boolean('date_changed')->default(false)->after('hearing_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_orders', function (Blueprint $table) {
            $table->dropColumn(['command_yes_note', 'command_yes_file', 'command_no_file', 'hearing_no', 'date_changed']);
        });
    }
};
