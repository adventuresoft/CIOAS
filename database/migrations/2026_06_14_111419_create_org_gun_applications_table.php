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
        Schema::create('org_gun_applications', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no')->unique();
            $table->text('org_name')->nullable();
            $table->text('org_address')->nullable();
            $table->date('operation_start_date')->nullable();
            $table->string('vault_limit')->nullable();
            $table->integer('vehicle_count')->default(0);
            $table->text('owner_or_ceo_details')->nullable();
            $table->text('organogram_manpower_details')->nullable();
            $table->boolean('bangladesh_bank_permission')->default(false);
            $table->text('tax_details')->nullable();
            $table->text('current_security_description')->nullable();
            $table->text('rental_agreement_details')->nullable();
            $table->integer('weapon_count_requested')->default(0);
            $table->string('weapon_nature_requested')->nullable();
            $table->text('justification_of_necessity')->nullable();
            $table->text('existing_weapons_details')->nullable();
            $table->enum('status', ['Submitted', 'Verified', 'Interviewed', 'Approved', 'Rejected'])->default('Submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_gun_applications');
    }
};
