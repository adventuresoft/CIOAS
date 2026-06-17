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
        Schema::table('inventory_requisition_items', function (Blueprint $table) {
            $table->decimal('vendor_unit_price', 12, 2)->nullable()->after('estimated_total_cost');
            $table->decimal('vendor_total_price', 12, 2)->nullable()->after('vendor_unit_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_requisition_items', function (Blueprint $table) {
            $table->dropColumn(['vendor_unit_price', 'vendor_total_price']);
        });
    }
};
