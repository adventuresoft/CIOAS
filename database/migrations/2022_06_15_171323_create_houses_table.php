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
            $table->string('en_name');
            $table->string('bn_name');
            $table->foreignId('institute_id')->constrained('institutes')->onDelete('cascade');
            $table->foreignId('village_id')->constrained('villages');
            $table->foreignId('union_ward_id')->constrained('union_wards');
            $table->foreignId('house_type_id')->constrained('house_types');
            $table->foreignId('house_category_id')->constrained('house_categories');
            $table->foreignId('house_owner_type_id')->constrained('house_owner_types');
            $table->foreignId('mouza_id')->constrained('mouzas');
            $table->string('brs_khatian')->nullable();
            $table->string('brs_dag')->nullable();
            $table->double('land_quantity', 8, 2)->default(0.00);
            $table->double('house_price', 8, 2)->default(0.00);
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
