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
        Schema::create('org_gun_guard_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_gun_application_id')->constrained()->cascadeOnDelete();
            $table->string('guard_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->string('nid_number')->nullable();
            $table->boolean('training_certificate_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_gun_guard_details');
    }
};
