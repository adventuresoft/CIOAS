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
        Schema::table('person_gun_applications', function (Blueprint $table) {
            $table->string('district_magistrate')->nullable()->after('institute_id');
            $table->string('application_class')->nullable()->after('district_magistrate');
            $table->string('applicant_name_en')->nullable()->after('applicant_name');
            $table->string('nid_no')->nullable()->after('applicant_name_en');
            $table->date('dob')->nullable()->after('nid_no');
            $table->integer('age_at_application')->nullable()->after('dob');
            $table->string('mother_profession')->nullable()->after('mother_name');
            $table->string('father_profession')->nullable()->after('father_name');
            $table->string('marital_status')->nullable()->after('father_profession');
            $table->string('spouse_name')->nullable()->after('marital_status');
            $table->string('spouse_profession')->nullable()->after('spouse_name');
            $table->string('nationality')->nullable()->after('spouse_profession');
            $table->string('religion')->nullable()->after('nationality');
            $table->string('education_qualification')->nullable()->after('religion');
            $table->text('profession_address')->nullable()->after('profession_details');
            $table->string('tin_no')->nullable()->after('income_source');
            $table->text('tax_history_details')->nullable()->after('tin_no');
            $table->boolean('is_govt_employee')->default(false)->after('tax_history_details');
            $table->string('cadre_service_name')->nullable()->after('is_govt_employee');
            $table->string('designation')->nullable()->after('cadre_service_name');
            $table->string('pay_grade_salary')->nullable()->after('designation');
            $table->text('workplace_address')->nullable()->after('pay_grade_salary');
            $table->string('duty_free_import')->nullable()->after('workplace_address');
            $table->boolean('license_cancelled_before')->default(false)->after('duty_free_import');
            $table->string('cancelled_weapon_type')->nullable()->after('license_cancelled_before');
            $table->text('cancellation_reason')->nullable()->after('cancelled_weapon_type');
            $table->text('necessity_reason')->nullable()->after('weapon_details');
            $table->boolean('affidavit_attached')->default(false)->after('cancellation_reason');
            $table->boolean('heir_deed_attached')->default(false)->after('affidavit_attached');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('person_gun_applications', function (Blueprint $table) {
            $table->dropColumn([
                'district_magistrate',
                'application_class',
                'applicant_name_en',
                'nid_no',
                'dob',
                'age_at_application',
                'mother_profession',
                'father_profession',
                'marital_status',
                'spouse_name',
                'spouse_profession',
                'nationality',
                'religion',
                'education_qualification',
                'profession_address',
                'tin_no',
                'tax_history_details',
                'is_govt_employee',
                'cadre_service_name',
                'designation',
                'pay_grade_salary',
                'workplace_address',
                'duty_free_import',
                'license_cancelled_before',
                'cancelled_weapon_type',
                'cancellation_reason',
                'necessity_reason',
                'affidavit_attached',
                'heir_deed_attached',
            ]);
        });
    }
};
