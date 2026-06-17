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
        Schema::create('person_gun_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_gun_application_id')->constrained()->cascadeOnDelete();
            $table->boolean('has_criminal_record')->default(false);
            $table->text('criminal_case_details')->nullable();
            $table->boolean('social_discipline_issue')->default(false);
            $table->boolean('practical_knowledge')->default(false);
            $table->text('life_threat_justification')->nullable();
            $table->boolean('certificate_verification_status')->default(false);
            $table->text('adverse_info')->nullable();
            $table->text('oc_comments')->nullable();
            $table->text('sp_dsb_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_gun_verifications');
    }
};
