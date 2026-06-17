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
        Schema::create('org_gun_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_gun_application_id')->constrained()->cascadeOnDelete();
            $table->foreignId('org_gun_guard_detail_id')->constrained()->cascadeOnDelete();
            $table->boolean('guard_physical_mental_capability')->default(false);
            $table->boolean('guard_weapon_knowledge')->default(false);
            $table->boolean('guard_behavior_satisfactory')->default(false);
            $table->boolean('safe_custody_capability')->default(false);
            $table->text('police_report_comments')->nullable();
            $table->text('magistrate_final_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_gun_interviews');
    }
};
