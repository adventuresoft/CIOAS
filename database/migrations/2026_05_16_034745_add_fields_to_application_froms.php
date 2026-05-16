<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToApplicationFroms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_froms', function (Blueprint $table) {
            $table->unsignedBigInteger('current_department_id')->nullable();
            $table->unsignedBigInteger('current_officer_id')->nullable();
            $table->unsignedBigInteger('receive_id')->nullable();
            $table->text('status')->nullable();
            $table->text('note')->nullable();
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
            $table->dropColumn('current_department_id');
            $table->dropColumn('current_officer_id');
            $table->dropColumn('receive_id');
            $table->dropColumn('status');
            $table->dropColumn('note');
        });
    }
}