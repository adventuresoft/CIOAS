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
        Schema::create('org_gun_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_gun_application_id')->constrained()->cascadeOnDelete();
            $table->boolean('weapon_necessity_approved')->default(false);
            $table->text('existing_weapons_verified')->nullable();
            $table->boolean('vault_limit_verified')->default(false);
            $table->boolean('guard_has_criminal_record')->default(false);
            $table->text('guard_case_details')->nullable();
            $table->boolean('guard_social_discipline_issue')->default(false);
            $table->boolean('guard_existing_license')->default(false);
            $table->boolean('guard_practical_knowledge')->default(false);
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
        Schema::dropIfExists('org_gun_verifications');
    }
};
