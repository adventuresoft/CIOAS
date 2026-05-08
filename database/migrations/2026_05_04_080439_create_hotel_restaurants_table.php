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

            $table->string('application_id', 20)->nullable()->index();
            $table->unsignedBigInteger('institute_id')->index();
            $table->string('system_id')->index();

            $table->string('name');
            $table->string('bn_name')->nullable();

            $table->unsignedBigInteger('hotel_category_id')->nullable();
            $table->unsignedBigInteger('hotel_subcategory_id')->nullable();
            $table->unsignedBigInteger('hotel_type_id')->nullable();

            $table->string('rjsc_reg_no')->nullable();

            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('post_office_id')->nullable();

            $table->integer('no_of_owner')->default(1);

            $table->unsignedBigInteger('village_id')->nullable();
            $table->integer('ward_id')->nullable();

            $table->string('road')->nullable();
            $table->string('house')->nullable();
            $table->string('house_bn')->nullable();

            $table->double('capital', 16, 2)->default(0.00);
            $table->integer('establish_year')->nullable();

            $table->enum('application_type', [ 'new', 'old' ])->default('new');

            $table->text('remarks')->nullable();
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('office_division_id')->nullable();
            $table->unsignedBigInteger('office_district_id')->nullable();
            $table->unsignedBigInteger('office_thana_id')->nullable();
            $table->unsignedBigInteger('office_post_office_id')->nullable();
            $table->unsignedBigInteger('office_village_id')->nullable();
            $table->unsignedBigInteger('office_ward_id')->nullable();

            $table->string('office_road')->nullable();
            $table->string('office_house')->nullable();
            $table->string('office_house_bn')->nullable();

            $table->string('premises_ownership')->nullable();

            $table->string('document_files', 255)->nullable();
            $table->string('hotel_logo', 255)->nullable();
            $table->string('no_of_dir', 255)->nullable();

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
