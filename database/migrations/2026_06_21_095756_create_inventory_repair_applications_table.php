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
        Schema::create('inventory_repair_applications', function (Blueprint $table) {
            $table->id();
            $table->string('repair_no')->unique();
            $table->date('application_date');
            $table->string('applicant_name')->nullable();
            $table->string('department_name')->nullable();
            $table->string('item_name');
            $table->string('product_type')->nullable();
            $table->string('category')->nullable();
            $table->string('unit')->nullable();
            $table->integer('quantity');
            $table->text('problem_description');
            $table->string('status')->default('pending'); // pending, approved, rejected, repaired
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_repair_applications');
    }
};
