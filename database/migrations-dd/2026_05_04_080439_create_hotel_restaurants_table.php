<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained('institutes')->onDelete('cascade');
            $table->string('system_id')->unique();

            $table->string('name');
            $table->string('bn_name')->nullable();

            $table->bigInteger('organization_category_id')->nullable();
            $table->bigInteger('organization_subcategory_id')->nullable();
            $table->json('organization_work_area_id')->nullable();
            $table->bigInteger('organization_type_id')->nullable();
            $table->string('rjsc_reg_no')->nullable();

            $table->bigInteger('organization_ownership_type_id')->nullable();
            $table->integer('no_of_owner')->default(1)->nullable();

            $table->bigInteger('village_id')->nullable();
            $table->bigInteger('union_ward_id')->nullable();
            $table->bigInteger('village_area_id')->nullable();
            $table->bigInteger('road_id')->nullable();
            $table->bigInteger('house_id')->nullable();

            $table->double('capital', 16, 2)->default(0.00)->nullable();
            $table->integer('establish_year')->nullable();
            $table->enum('application_type', [ 'new', 'old' ])->default('new')->nullable();
            $table->text('remarks')->nullable();
            $table->bigInteger('office_division_id')->nullable();
            $table->bigInteger('office_district_id')->nullable();
            $table->bigInteger('office_thana_id')->nullable();
            $table->bigInteger('office_post_office_id')->nullable();
            $table->bigInteger('office_village_id')->nullable();
            $table->bigInteger('office_ward_id')->nullable();
            $table->string('office_road')->nullable();
            $table->string('office_house')->nullable();
            $table->string('office_house_bn')->nullable();
            $table->string('premises_ownership')->nullable();

            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('hotel_restaurants');
    }
}
