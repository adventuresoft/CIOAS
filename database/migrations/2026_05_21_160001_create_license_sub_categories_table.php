<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('license_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('license_category_id');
            $table->string('en_name');
            $table->string('bn_name');
            $table->string('slug')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('license_category_id')
                ->references('id')
                ->on('license_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('license_sub_categories');
    }
}
