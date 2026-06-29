<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('license_ownerships', function (Blueprint $table) {
            $table->id();

            $table->string('application_id')->nullable();

            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('nid')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();

            $table->string('father_name')->nullable();
            $table->string('father_name_bn')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_name_bn')->nullable();

            $table->string('permanent_division')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_thana')->nullable();
            $table->string('permanent_post_office')->nullable();
            $table->unsignedBigInteger('permanent_village_id')->nullable();
            $table->unsignedBigInteger('permanent_ward_id')->nullable();
            $table->string('permanent_road')->nullable();
            $table->string('permanent_house')->nullable();
            $table->string('permanent_house_bn')->nullable();

            $table->string('present_division')->nullable();
            $table->unsignedBigInteger('present_district_id')->nullable();
            $table->unsignedBigInteger('present_thana_id')->nullable();
            $table->unsignedBigInteger('present_post_office_id')->nullable();
            $table->unsignedBigInteger('present_village_id')->nullable();
            $table->unsignedBigInteger('present_ward_id')->nullable();
            $table->string('present_road')->nullable();
            $table->string('present_house')->nullable();
            $table->string('present_house_bn')->nullable();

            $table->string('photo')->nullable();
            $table->string('signature')->nullable();

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
        Schema::dropIfExists('license_ownerships');
    }
};
