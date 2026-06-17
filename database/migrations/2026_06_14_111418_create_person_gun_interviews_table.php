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
        Schema::create('person_gun_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_gun_application_id')->constrained()->cascadeOnDelete();
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->boolean('physical_mental_fitness')->default(false);
            $table->boolean('weapon_handling_knowledge')->default(false);
            $table->boolean('gun_law_knowledge')->default(false);
            $table->boolean('safe_custody_capability')->default(false);
            $table->boolean('safety_necessity_justification')->default(false);
            $table->boolean('behavior_satisfactory')->default(false);
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
        Schema::dropIfExists('person_gun_interviews');
    }
};
