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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('registration_no')->nullable();
            
            $table->string('rc_attachment')->nullable();
            $table->date('rc_issue_date')->nullable();
            $table->date('rc_validity_date')->nullable();

            $table->string('rp_attachment')->nullable();
            $table->date('rp_issue_date')->nullable();
            $table->date('rp_validity_date')->nullable();

            $table->string('tt_attachment')->nullable();
            $table->date('tt_issue_date')->nullable();
            $table->date('tt_validity_date')->nullable();

            $table->string('in_attachment')->nullable();
            $table->date('in_issue_date')->nullable();
            $table->date('in_validity_date')->nullable();

            $table->string('driver_registration_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'registration_no',
                'rc_attachment', 'rc_issue_date', 'rc_validity_date',
                'rp_attachment', 'rp_issue_date', 'rp_validity_date',
                'tt_attachment', 'tt_issue_date', 'tt_validity_date',
                'in_attachment', 'in_issue_date', 'in_validity_date',
                'driver_registration_no'
            ]);
        });
    }
};
