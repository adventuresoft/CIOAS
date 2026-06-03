<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('details')->nullable();
            $table->string('applicant_name');
            $table->string('father_name')->nullable();
            $table->string('nid_number')->nullable();
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('proof_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
}
