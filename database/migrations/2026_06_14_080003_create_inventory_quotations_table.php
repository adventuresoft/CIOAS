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
        Schema::create('inventory_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_no')->unique();
            $table->date('quotation_date');
            $table->string('department_name')->nullable();
            $table->string('applicant_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('mobile_number', 30)->nullable();
            $table->string('email_address')->nullable();
            $table->text('purpose')->nullable();
            $table->string('priority_level')->default('Normal');
            $table->string('workflow_status')->default('draft');
            $table->unsignedTinyInteger('current_step')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_quotation_id')
                  ->constrained('inventory_quotations')
                  ->cascadeOnDelete();
            $table->string('item_name');
            $table->string('category')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_quotation_items');
        Schema::dropIfExists('inventory_quotations');
    }
};
