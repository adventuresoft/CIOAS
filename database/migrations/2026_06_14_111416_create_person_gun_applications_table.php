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
        Schema::create('person_gun_applications', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no')->unique();
            $table->string('applicant_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('profession_details')->nullable();
            $table->text('weapon_details')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('income_source')->nullable();
            $table->enum('status', ['Submitted', 'Verified', 'Interviewed', 'Approved', 'Rejected'])->default('Submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_gun_applications');
    }
};
