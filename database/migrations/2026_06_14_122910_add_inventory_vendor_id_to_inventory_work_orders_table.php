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
        Schema::table('inventory_work_orders', function (Blueprint $table) {
            $table->foreignId('inventory_vendor_id')->nullable()->constrained('inventory_vendors')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_work_orders', function (Blueprint $table) {
            $table->dropForeign(['inventory_vendor_id']);
            $table->dropColumn('inventory_vendor_id');
        });
    }
};
