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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->integer('approved_by')->nullable();
            $table->integer('current_department_id')->nullable();
            $table->integer('current_section_id')->nullable();
            $table->integer('receive_id')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('approval_note', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn('approved_by');
            $table->dropColumn('current_department_id');
            $table->dropColumn('current_section_id');
        });
    }
};
