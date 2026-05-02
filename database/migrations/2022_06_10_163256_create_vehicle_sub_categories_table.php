<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_category_id')->constrained('vehicle_categories')->onDelete('cascade');
            $table->string('en_name');
            $table->string('bn_name');
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1)->comment('0=>Inactive, 1=>Active');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('vehicle_sub_categories');
    }
}
