<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->float('distance', 16, 2)->default(0.00);
            $table->bigInteger('institute_id')->nullable();
            $table->bigInteger('road_type_id')->nullable();
            $table->bigInteger('road_category_id')->nullable();
            $table->bigInteger('road_owner_id')->nullable();
            $table->string('start_point')->nullable();
            $table->string('end_point')->nullable();
            $table->string('make_year')->nullable();
            $table->string('make_contactor')->nullable();
            $table->double('make_value', 16,2)->default(0.00);
            $table->string('current_condition')->nullable();
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
        Schema::dropIfExists('roads');
    }
}
