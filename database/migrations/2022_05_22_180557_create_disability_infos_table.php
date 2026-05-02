<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisabilityInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disability_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_disability')->default(false);
            $table->bigInteger('disability_name_id')->nullable();
            $table->bigInteger('disability_category_id')->nullable();
            $table->bigInteger('disability_type_id')->nullable();
            $table->string('start_date')->nullable();
            $table->bigInteger('treatment_status_id')->nullable();
            $table->string('disability_doctor')->nullable();
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
        Schema::dropIfExists('disability_infos');
    }
}
