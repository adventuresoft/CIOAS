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
        Schema::create('other_org_gun_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->string('tracking_no')->unique();
            $table->string('org_name');
            $table->string('org_type')->default('other');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('org_address')->nullable();
            $table->date('operation_start_date')->nullable();
            $table->text('organogram_manpower_details')->nullable();
            $table->string('has_trade_license_mou_aou')->nullable();
            $table->text('owner_or_ceo_details')->nullable();
            $table->string('rental_agreement_details')->nullable();
            $table->string('tin_no')->nullable();
            $table->text('tax_history')->nullable();
            $table->string('paid_up_capital')->nullable();
            $table->text('existing_weapons_details')->nullable();
            $table->text('safe_custody_details')->nullable();
            $table->integer('trained_guard_count')->default(0);
            $table->string('police_report_for_guard')->nullable();
            $table->string('guard_cv')->nullable();
            $table->string('status')->default('Submitted'); // Submitted, Verified, Interviewed, Approved, Rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_org_gun_applications');
    }
};
