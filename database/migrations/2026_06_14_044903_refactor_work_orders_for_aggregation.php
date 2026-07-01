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
        $columnsToDrop = [];
        foreach (['vendor_id', 'vendor_name', 'inventory_requisition_id'] as $col) {
            if (Schema::hasColumn('inventory_work_orders', $col)) {
                $columnsToDrop[] = $col;
            }
        }
        if (!empty($columnsToDrop)) {
            Schema::table('inventory_work_orders', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }

        if (!Schema::hasTable('inventory_requisition_work_order')) {
            Schema::create('inventory_requisition_work_order', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('inventory_requisition_id');
                $table->unsignedBigInteger('inventory_work_order_id');
                $table->timestamps();

                $table->foreign('inventory_requisition_id', 'irwo_req_id_foreign')->references('id')->on('inventory_requisitions')->onDelete('cascade');
                $table->foreign('inventory_work_order_id', 'irwo_wo_id_foreign')->references('id')->on('inventory_work_orders')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_requisition_work_order');

        Schema::table('inventory_work_orders', function (Blueprint $table) {
            $table->string('vendor_id')->nullable();
            $table->string('vendor_name')->nullable();
            $table->unsignedBigInteger('inventory_requisition_id')->nullable();
        });
    }
};
