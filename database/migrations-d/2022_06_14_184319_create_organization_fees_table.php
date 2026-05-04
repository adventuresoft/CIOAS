<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_fees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tax_year_id')->nullable();
            $table->bigInteger('institute_type_id')->nullable();
            $table->bigInteger('organization_category_id')->nullable();
            $table->bigInteger('organization_subcategory_id')->nullable();
            $table->string("name")->nullable();
            $table->double('category_a_fees', 16, 2)->default(0.00);
            $table->double('category_b_fees', 16, 2)->default(0.00);
            $table->double('category_c_fees', 16, 2)->default(0.00);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('organization_fees');
    }
}
