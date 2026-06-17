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
            $table->string('chalan_no')->nullable()->after('inventory_vendor_id');
            $table->string('invoice_no')->nullable()->after('chalan_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_work_orders', function (Blueprint $table) {
            $table->dropColumn(['chalan_no', 'invoice_no']);
        });
    }
};
