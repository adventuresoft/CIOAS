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
        Schema::table('institutes', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable()->after('id');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropColumn('division_id');
        });
    }
};
