<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_category_id');
            $table->bigInteger('institute_subcategory_id')->nullable();
            $table->bigInteger('institute_type_id');
            $table->bigInteger('union_id')->nullable();
            $table->bigInteger('pourashava_id')->nullable();
            $table->bigInteger('city_corporation_id')->nullable();

            $table->date('activation_time')->nullable();
            $table->string('top_image')->nullable();
            $table->string('left_image')->nullable();
            $table->string('right_image')->nullable();
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
        Schema::dropIfExists('institutes');
    }
}
