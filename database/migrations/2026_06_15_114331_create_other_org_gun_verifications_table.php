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
        Schema::create('other_org_gun_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('other_org_gun_application_id');
            $table->text('necessity_justification')->nullable();
            $table->string('existing_weapons_verification')->nullable();
            $table->text('weapon_details')->nullable();
            $table->string('guard_name')->nullable();
            $table->string('guard_mother_name')->nullable();
            $table->text('guard_father_name_address')->nullable();
            $table->string('guard_nid')->nullable();
            $table->string('social_discipline_issue')->nullable();
            $table->string('criminal_case_status')->nullable();
            $table->string('conviction_status')->nullable();
            $table->string('guard_existing_license')->nullable();
            $table->string('practical_knowledge')->nullable();
            $table->string('certificate_verification_status')->nullable();
            $table->text('adverse_info')->nullable();
            $table->boolean('safe_custody_capability')->default(false);
            $table->text('oc_comments')->nullable();
            $table->text('sp_dsb_comments')->nullable();
            $table->timestamps();

            $table->foreign('other_org_gun_application_id', 'ooga_id_foreign')->references('id')->on('other_org_gun_applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_org_gun_verifications');
    }
};
