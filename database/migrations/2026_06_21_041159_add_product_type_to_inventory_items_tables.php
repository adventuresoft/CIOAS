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
            $table->string('product_type')->nullable()->before('category');
        });
        Schema::table('inventory_quotation_items', function (Blueprint $table) {
            $table->string('product_type')->nullable()->before('category');
        });
        Schema::table('inventory_work_order_items', function (Blueprint $table) {
            $table->string('product_type')->nullable()->before('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_requisition_items', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
        Schema::table('inventory_quotation_items', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
        Schema::table('inventory_work_order_items', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
    }
};
