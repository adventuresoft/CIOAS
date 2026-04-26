<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('family_type_id');
            $table->bigInteger('family_category_id')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_name_bn')->nullable();

            $table->bigInteger('father_live_status')->default(true);
            $table->string('father_nid')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_name_bn')->nullable();
            $table->bigInteger('mother_live_status')->default(true);
            $table->string('mother_nid')->nullable();
            $table->bigInteger('marital_status')->default(false);
            $table->string('spouse_name')->nullable();
            $table->string('spouse_nid')->nullable();
            $table->string('married_date')->nullable();
            $table->boolean('have_children')->default(false);
            $table->integer('boys')->nullable();
            $table->integer('girls')->nullable();
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
        Schema::dropIfExists('family_infos');
    }
}
