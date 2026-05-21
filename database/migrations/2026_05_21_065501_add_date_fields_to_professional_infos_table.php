<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateFieldsToProfessionalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professional_infos', function (Blueprint $table) {
            $table->date('recruitment_notice_date')->nullable()->after('recruitment_notice_no');
            $table->date('appointment_letter_date')->nullable()->after('appointment_letter_no');
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
            $table->dropColumn(['recruitment_notice_date', 'appointment_letter_date']);
        });
    }
}
