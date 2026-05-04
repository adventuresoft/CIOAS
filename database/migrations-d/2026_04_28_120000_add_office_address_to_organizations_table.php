<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeAddressToOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->bigInteger('office_division_id')->nullable();
            $table->bigInteger('office_district_id')->nullable();
            $table->bigInteger('office_thana_id')->nullable();
            $table->bigInteger('office_post_office_id')->nullable();
            $table->bigInteger('office_village_id')->nullable();
            $table->bigInteger('office_ward_id')->nullable();
            $table->string('office_road')->nullable();
            $table->string('office_house')->nullable();
            $table->string('office_house_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn([
                'office_division_id',
                'office_district_id',
                'office_thana_id',
                'office_post_office_id',
                'office_village_id',
                'office_ward_id',
                'office_road',
                'office_house',
                'office_house_bn',
            ]);
        });
    }
}
