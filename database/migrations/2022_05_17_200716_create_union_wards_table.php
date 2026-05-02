<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_wards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('en_ward_no');
            $table->string('bn_ward_no');
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
        Schema::dropIfExists('union_wards');
    }
}
