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
        Schema::table('lands', function (Blueprint $table) {
            $table->json('locations')->nullable()->after('land_no');
            $table->json('details')->nullable()->after('locations');
            $table->json('documents')->nullable()->after('details');
        });

        Schema::dropIfExists('land_locations');
        Schema::dropIfExists('land_details');
        Schema::dropIfExists('land_documents');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->dropColumn(['locations', 'details', 'documents']);
        });
    }
};
