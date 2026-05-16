<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApplicationIDToApplicationFroms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_froms', function (Blueprint $table) {
            $table->text('application_number');
            $table->text('address')->nullable();
            $table->text('father_name')->nullable();
            $table->text('email')->nullable();
            $table->text('form_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_froms', function (Blueprint $table) {
            $table->dropColumn('application_number');
            $table->dropColumn('form_type');
            $table->dropColumn('address');
            $table->dropColumn('father_name');
            $table->dropColumn('email');
        });
    }
}