<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('bp')->nullable();
            $table->string('bp_up')->nullable();
            $table->string('bp_down')->nullable();

            $table->string('diabetes')->nullable();
            $table->string('diabetes_start_date')->nullable();
            $table->string('diabetes_status')->nullable();
            $table->string('diabetes_treatment_status')->nullable();
            $table->string('diabetes_doctor')->nullable();

            $table->string('azma')->nullable();
            $table->string('azma_start_date')->nullable();
            $table->string('azma_status')->nullable();
            $table->string('azma_treatment_status')->nullable();
            $table->string('azma_doctor')->nullable();

            $table->string('kidney')->nullable();
            $table->string('kidney_start_date')->nullable();
            $table->string('kidney_status')->nullable();
            $table->string('kidney_treatment_status')->nullable();
            $table->string('kidney_doctor')->nullable();

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
        Schema::dropIfExists('health_infos');
    }
}
