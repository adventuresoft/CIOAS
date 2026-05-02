<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('bn_name')->nullable();
            $table->string('date_of_birth')->nullable();

            $table->bigInteger('birth_place')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('country_id')->nullable();
            
            $table->bigInteger('gender')->nullable();
            $table->bigInteger('religion_id')->nullable();
            $table->bigInteger('blood_group')->nullable();
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
        Schema::dropIfExists('people');
    }
}
