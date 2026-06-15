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
        Schema::create('other_org_gun_interviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('other_org_gun_application_id');
            $table->string('applicant_name_designation')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->boolean('documents_correct')->default(false);
            
            $table->string('guard_name')->nullable();
            $table->string('guard_father_name')->nullable();
            $table->string('guard_mother_name')->nullable();
            $table->text('guard_present_address')->nullable();
            $table->text('guard_permanent_address')->nullable();
            $table->string('guard_age')->nullable();
            $table->string('guard_education')->nullable();
            
            $table->boolean('physical_mental_fitness')->default(false);
            $table->boolean('weapon_handling_knowledge')->default(false);
            $table->boolean('behavior_satisfactory')->default(false);
            
            $table->text('police_report_comments')->nullable();
            $table->text('magistrate_final_comments')->nullable();
            $table->timestamps();

            $table->foreign('other_org_gun_application_id', 'ooga_interview_id_foreign')->references('id')->on('other_org_gun_applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_org_gun_interviews');
    }
};
