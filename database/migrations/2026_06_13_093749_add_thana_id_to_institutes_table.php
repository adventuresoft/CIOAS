<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->unsignedBigInteger('thana_id')->nullable()->after('district_id');
            $table->foreign('thana_id')->references('id')->on('thanas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropForeign(['thana_id']);
            $table->dropColumn('thana_id');
        });
    }
};
