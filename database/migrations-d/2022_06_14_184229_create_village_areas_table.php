<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillageAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->foreignId('thana_id')->constrained('thanas')->onDelete('cascade');
            $table->foreignId('union_id')->constrained('unions')->onDelete('cascade');
            $table->foreignId('village_id')->constrained('villages')->onDelete('cascade');
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
        Schema::dropIfExists('village_areas');
    }
}
