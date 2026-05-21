<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmploymentFieldsToProfessionalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professional_infos', function (Blueprint $table) {
            $table->string('recruitment_notice_no')->nullable();
            $table->string('appointment_letter_no')->nullable();
            $table->string('designation_joining')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('department')->nullable();
            $table->string('current_designation')->nullable();
            $table->date('date_current_designation')->nullable();
            $table->string('current_workplace')->nullable();
            $table->date('date_joining_current_workplace')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professional_infos', function (Blueprint $table) {
            $table->dropColumn([
                'recruitment_notice_no',
                'appointment_letter_no',
                'designation_joining',
                'date_of_joining',
                'department',
                'current_designation',
                'date_current_designation',
                'current_workplace',
                'date_joining_current_workplace'
            ]);
        });
    }
}
