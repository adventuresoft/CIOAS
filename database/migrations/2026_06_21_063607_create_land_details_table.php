<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_id')->constrained('lands')->onDelete('cascade');
            $table->string('dag_no');
            $table->string('khatian_no');
            $table->string('recorded_owner_name')->nullable();
            $table->string('recorded_class');
            $table->string('actual_class');
            $table->double('total_land', 15, 4)->nullable();
            $table->double('land_amount', 15, 4)->nullable();
            $table->string('possession_status');
            $table->string('case_no')->nullable();
            $table->string('gazette_no')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('land_details');
    }
};
