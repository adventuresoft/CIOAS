<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_no')->unique();
            $table->date('application_date');
            $table->string('department_name');
            $table->string('applicant_name');
            $table->string('designation')->nullable();
            $table->string('mobile_number', 30)->nullable();
            $table->string('email_address')->nullable();
            $table->text('purpose');
            $table->string('priority_level')->default('Normal');
            $table->string('workflow_status')->default('draft');
            $table->unsignedTinyInteger('current_step')->default(1);

            $table->string('department_head_recommendation')->nullable();
            $table->decimal('department_head_recommended_quantity', 12, 2)->nullable();
            $table->text('department_head_remarks')->nullable();

            $table->string('ndc_budget_availability')->nullable();
            $table->boolean('ndc_stock_verification_required')->default(false);
            $table->text('ndc_budget_remarks')->nullable();
            $table->string('ndc_recommendation')->nullable();
            $table->text('ndc_comments')->nullable();

            $table->string('adc_administrative_status')->nullable();
            $table->string('adc_financial_status')->nullable();
            $table->text('adc_remarks')->nullable();

            $table->string('dc_final_decision')->nullable();
            $table->text('dc_remarks')->nullable();

            $table->string('issue_slip_number')->nullable()->unique();
            $table->date('issue_date')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_designation')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('store_officer')->nullable();
            $table->string('received_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_requisition_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_requisition_id')
                ->constrained('inventory_requisitions')
                ->cascadeOnDelete();
            $table->string('item_name');
            $table->string('category')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('required_quantity', 12, 2)->default(0);
            $table->decimal('estimated_unit_cost', 12, 2)->default(0);
            $table->decimal('estimated_total_cost', 12, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->decimal('requested_quantity', 12, 2)->nullable();
            $table->decimal('available_quantity', 12, 2)->nullable();
            $table->decimal('issue_quantity', 12, 2)->nullable();
            $table->string('stock_status')->nullable();
            $table->decimal('approved_quantity', 12, 2)->nullable();
            $table->decimal('issued_quantity', 12, 2)->nullable();
            $table->text('store_remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('inventory_workflow_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_requisition_id')
                ->constrained('inventory_requisitions')
                ->cascadeOnDelete();
            $table->string('stage_name');
            $table->string('status');
            $table->string('actor_name')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('action_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_workflow_logs');
        Schema::dropIfExists('inventory_requisition_items');
        Schema::dropIfExists('inventory_requisitions');
    }
};
