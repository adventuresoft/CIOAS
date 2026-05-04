<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('system_id');
            $table->bigInteger('institute_id');
            $table->bigInteger('tax_year_id')->nullable();
            $table->bigInteger('village_id')->nullable();
            $table->bigInteger('ward_id')->nullable();
            $table->bigInteger('area_id')->nullable();
            $table->bigInteger('house_id')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('user_system_id');

            $table->double('previous_residence_tax', 16, 2)->default(0.00)->nullable();
            $table->double('previous_income_tax', 16, 2)->default(0.00)->nullable();
            $table->double('previous_entertainment_institute_tax', 16, 2)->default(0.00)->nullable();
            $table->double('previous_license_tax', 16, 2)->default(0.00)->nullable();
            $table->double('previous_bazar_tax', 16, 2)->default(0.00)->nullable();
            $table->double('previous_land_tax', 16, 2)->default(0.00)->nullable();
            $table->double('previous_auction_tax', 16, 2)->default(0.00)->nullable();
            $table->double('previous_fine', 16, 2)->default(0.00)->nullable();
            $table->double('previous_others', 16, 2)->default(0.00)->nullable();
            $table->double('previous_extra', 16, 2)->default(0.00)->nullable();

            $table->double('residence_tax', 16, 2)->default(0.00)->nullable();
            $table->double('income_tax', 16, 2)->default(0.00)->nullable();
            $table->double('entertainment_institute_tax', 16, 2)->default(0.00)->nullable();
            $table->double('license_tax', 16, 2)->default(0.00)->nullable();
            $table->double('bazar_tax', 16, 2)->default(0.00)->nullable();
            $table->double('land_tax', 16, 2)->default(0.00)->nullable();
            $table->double('auction_tax', 16, 2)->default(0.00)->nullable();
            $table->double('fine', 16, 2)->default(0.00)->nullable();
            $table->double('others', 16, 2)->default(0.00)->nullable();
            $table->double('extra', 16, 2)->default(0.00)->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('taxes');
    }
}
