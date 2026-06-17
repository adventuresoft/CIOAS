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
            $table->dropColumn(['department_name', 'applicant_name', 'designation', 'mobile_number', 'email_address', 'purpose', 'priority_level']);
            
            $table->string('vendor_id')->nullable()->after('application_date');
            $table->string('vendor_name')->nullable()->after('vendor_id');
            $table->unsignedBigInteger('inventory_requisition_id')->nullable()->after('vendor_name');
        });

        Schema::table('inventory_work_order_items', function (Blueprint $table) {
            $table->dropColumn(['estimated_unit_cost', 'estimated_total_cost', 'remarks', 'approved_quantity']);
            
            $table->decimal('purchase_quantity', 12, 2)->nullable()->after('required_quantity');
            $table->decimal('additional_quantity', 12, 2)->nullable()->after('purchase_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_work_orders', function (Blueprint $table) {
            $table->dropColumn(['vendor_id', 'vendor_name', 'inventory_requisition_id']);
            
            $table->string('department_name')->nullable();
            $table->string('applicant_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email_address')->nullable();
            $table->text('purpose')->nullable();
            $table->string('priority_level')->nullable();
        });

        Schema::table('inventory_work_order_items', function (Blueprint $table) {
            $table->dropColumn(['purchase_quantity', 'additional_quantity']);
            
            $table->decimal('estimated_unit_cost', 12, 2)->nullable();
            $table->decimal('estimated_total_cost', 12, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->decimal('approved_quantity', 12, 2)->nullable();
        });
    }
};
