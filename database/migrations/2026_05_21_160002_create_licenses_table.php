<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('application_id', 20)->nullable()->index();
            $table->unsignedBigInteger('institute_id')->nullable()->index();
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->unsignedBigInteger('license_category_id')->nullable();
            $table->unsignedBigInteger('license_subcategory_id')->nullable();
            $table->string('license_no')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->enum('application_type', ['new', 'old'])->default('new')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('license_category_id')
                ->references('id')
                ->on('license_categories')
                ->onDelete('set null');
            $table->foreign('license_subcategory_id')
                ->references('id')
                ->on('license_sub_categories')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}
