<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('license_categories', function (Blueprint $table) {
            $table->id();
            $table->string('en_name')->unique();
            $table->string('bn_name')->unique();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('license_categories');
    }
}
