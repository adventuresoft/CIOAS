<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mouzas', function (Blueprint $table) {
            $table->dropColumn('thana_id');
            $table->foreignId('upazila_id')->nullable()->constrained('upazilas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mouzas', function (Blueprint $table) {
            $table->dropForeign(['upazila_id']);
            $table->dropColumn('upazila_id');
            $table->unsignedBigInteger('thana_id')->nullable();
        });
    }
};
