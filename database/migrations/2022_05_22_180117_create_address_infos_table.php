<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('permanent_division_id')->nullable();
            $table->bigInteger('permanent_district_id')->nullable();
            $table->bigInteger('permanent_thana_id')->nullable();
            $table->bigInteger('permanent_union_id')->nullable();
            $table->bigInteger('permanent_ward_id')->nullable();
            $table->bigInteger('permanent_village_id')->nullable();
            $table->bigInteger('permanent_village_area_id')->nullable();
            $table->string('permanent_road')->nullable();
            $table->string('permanent_house')->nullable();
            $table->string('permanent_flat')->nullable();
            $table->string('permanent_area')->nullable();
            $table->string('permanent_area_bn')->nullable();

            $table->bigInteger('present_division_id')->nullable();
            $table->bigInteger('present_district_id')->nullable();
            $table->bigInteger('present_thana_id')->nullable();
            $table->bigInteger('present_union_id')->nullable();
            $table->bigInteger('present_ward_id')->nullable();
            $table->bigInteger('present_village_id')->nullable();
            $table->bigInteger('present_village_area_id')->nullable();

            $table->string('present_road')->nullable();
            $table->string('present_house')->nullable();
            $table->string('present_flat')->nullable();
            $table->string('present_area')->nullable();
            $table->string('present_area_bn')->nullable();
            $table->string('present_start_date')->nullable();
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
        Schema::dropIfExists('address_infos');
    }
}
