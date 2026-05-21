<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHotelStyleFieldsToLicensesTable extends Migration
{
    public function up()
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->unsignedBigInteger('license_type_id')->nullable()->after('license_subcategory_id');
            $table->string('rjsc_reg_no')->nullable()->after('license_type_id');
            $table->integer('no_of_owner')->nullable()->after('rjsc_reg_no');
            $table->string('no_of_dir')->nullable()->after('no_of_owner');
            $table->double('capital', 16, 2)->nullable()->after('no_of_dir');
            $table->integer('establish_year')->nullable()->after('capital');

            $table->integer('division_id')->nullable()->after('remarks');
            $table->integer('district_id')->nullable()->after('division_id');
            $table->integer('thana_id')->nullable()->after('district_id');
            $table->integer('post_office_id')->nullable()->after('thana_id');
            $table->integer('union_id')->nullable()->after('post_office_id');
            $table->integer('village_id')->nullable()->after('union_id');
            $table->integer('city_id')->nullable()->after('village_id');
            $table->integer('pos_id')->nullable()->after('city_id');
            $table->integer('ward_id')->nullable()->after('pos_id');
            $table->string('road')->nullable()->after('ward_id');
            $table->string('house')->nullable()->after('road');
            $table->string('house_bn')->nullable()->after('house');
            $table->string('location_type')->nullable()->after('house_bn');

            $table->unsignedBigInteger('office_division_id')->nullable()->after('location_type');
            $table->unsignedBigInteger('office_district_id')->nullable()->after('office_division_id');
            $table->unsignedBigInteger('office_thana_id')->nullable()->after('office_district_id');
            $table->unsignedBigInteger('office_post_office_id')->nullable()->after('office_thana_id');
            $table->unsignedBigInteger('office_union_id')->nullable()->after('office_post_office_id');
            $table->unsignedBigInteger('office_village_id')->nullable()->after('office_union_id');
            $table->unsignedBigInteger('office_city_id')->nullable()->after('office_village_id');
            $table->unsignedBigInteger('office_pos_id')->nullable()->after('office_city_id');
            $table->unsignedBigInteger('office_ward_id')->nullable()->after('office_pos_id');
            $table->string('office_road')->nullable()->after('office_ward_id');
            $table->string('office_house')->nullable()->after('office_road');
            $table->string('office_house_bn')->nullable()->after('office_house');
            $table->string('office_location_type')->nullable()->after('office_house_bn');

            $table->string('premises_ownership')->nullable()->after('office_location_type');
            $table->string('document_files')->nullable()->after('premises_ownership');
            $table->string('license_logo')->nullable()->after('document_files');
        });
    }

    public function down()
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->dropColumn([
                'license_type_id',
                'rjsc_reg_no',
                'no_of_owner',
                'no_of_dir',
                'capital',
                'establish_year',
                'division_id',
                'district_id',
                'thana_id',
                'post_office_id',
                'union_id',
                'village_id',
                'city_id',
                'pos_id',
                'ward_id',
                'road',
                'house',
                'house_bn',
                'location_type',
                'office_division_id',
                'office_district_id',
                'office_thana_id',
                'office_post_office_id',
                'office_union_id',
                'office_village_id',
                'office_city_id',
                'office_pos_id',
                'office_ward_id',
                'office_road',
                'office_house',
                'office_house_bn',
                'office_location_type',
                'premises_ownership',
                'document_files',
                'license_logo',
            ]);
        });
    }
}
