<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_fees', function (Blueprint $table) {
            $table->id();
            $table->string('finance_year');
            $table->string('vehicle_type');
            $table->string('vehicle_category');
            $table->string('fee_for')->comment('new|renew');
            $table->double('registration_fee', 16, 2)->default(0.00);
            $table->double('road_fee', 16, 2)->default(0.00);
            $table->double('fitness_fee', 16, 2)->default(0.00);
            $table->double('vat_fee', 16, 2)->default(0.00);
            $table->double('tax_fee', 16, 2)->default(0.00);
            $table->double('total_fee', 16, 2)->default(0.00);
            $table->timestamps();

            $table->unique(
                ['finance_year', 'vehicle_type', 'vehicle_category', 'fee_for'],
                'vehicle_fee_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_fees');
    }
}

