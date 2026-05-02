<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->boolean('is_property')->default(false)->nullable();

            $table->double('cash_amount', 16, 2)->default(0.00)->nullable();
            $table->string('tin_number')->nullable();

            $table->boolean('house')->default(0)->comment("1=>Yes, 0=>No");
            $table->string("house_type")->nullable();
            $table->string("house_area")->nullable();
            $table->string("house_land_quantity")->nullable();
            $table->double("house_price", 16, 2)->default(0.00);
            $table->string("house_ownership_status")->nullable();
            $table->string("house_address")->nullable();

            $table->boolean('land')->default(0)->comment("1=>Yes, 0=>No");
            $table->bigInteger('land_district_id')->nullable();
            $table->bigInteger('land_thana_id')->nullable();
            $table->bigInteger('land_mouza_id')->nullable();
            $table->bigInteger('land_khatian_id')->nullable();
            $table->string('land_dag_no')->nullable();
            $table->string('land_bs')->nullable();
            $table->string('land_rs')->nullable();
            $table->string('land_sa')->nullable();
            $table->string('land_cs')->nullable();
            $table->string('land_quantity')->nullable();
            $table->string('land_type')->nullable();
            $table->string("land_ownership_status")->nullable();

            $table->boolean('flat')->default(0)->comment("1=>Yes, 0=>No");
            $table->bigInteger('flat_district_id')->nullable();
            $table->bigInteger('flat_thana_id')->nullable();
            $table->bigInteger('flat_mouza_id')->nullable();
            $table->string('flat_area')->nullable();
            $table->string('flat_road')->nullable();
            $table->string('flat_house_no')->nullable();
            $table->string('flat_quantity')->nullable();
            $table->double("flat_price", 16, 2)->default("0.00");
            $table->string("flat_ownership_status")->nullable();

            $table->boolean('diamond')->default(0)->comment("1=>Yes, 0=>No");
            $table->string('diamond_type')->nullable();
            $table->string('diamond_quantity')->nullable();
            $table->double('diamond_price', 16, 2)->default("0.00");
            $table->string("diamond_ownership_status")->nullable();

            $table->boolean('gold')->default(0)->comment("1=>Yes, 0=>No");
            $table->string('gold_type')->nullable();
            $table->string('gold_quantity')->nullable();
            $table->double('gold_price', 16, 2)->default("0.00");
            $table->string("gold_ownership_status")->nullable();

            $table->boolean('silver')->default(0)->comment("1=>Yes, 0=>No");
            $table->string('silver_type')->nullable();
            $table->string('silver_quantity')->nullable();
            $table->double('silver_price', 16, 2)->default("0.00");
            $table->string("silver_ownership_status")->nullable();
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
        Schema::dropIfExists('property_infos');
    }
}
