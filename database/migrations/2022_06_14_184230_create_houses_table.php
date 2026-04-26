<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            
            $table->string('house');
            $table->string('house_bn')->nullable();

            $table->foreignId('institute_id')->constrained('institutes')->onDelete('cascade');
       
            $table->bigInteger('union_ward_id')->nullable();
            $table->bigInteger('village_id')->nullable();
            $table->bigInteger('village_area_id')->nullable();
            $table->bigInteger('house_type_id')->nullable();
            $table->bigInteger('house_category_id')->nullable();
            $table->bigInteger('house_owner_type_id')->nullable();
            $table->bigInteger('mouza_id')->nullable();

            $table->string('brs_khatian')->nullable();
            $table->string('brs_dag')->nullable();
            $table->double('land_quantity', 16, 2)->default(0.00)->nullable();
            $table->double('house_price', 16, 2)->default(0.00)->nullable();
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
        Schema::dropIfExists('houses');
    }
}
