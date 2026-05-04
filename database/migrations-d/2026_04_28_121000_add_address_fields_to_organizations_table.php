<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->bigInteger('division_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('thana_id')->nullable();
            $table->bigInteger('post_office_id')->nullable();
            $table->bigInteger('union_id')->nullable();
            $table->bigInteger('ward_id')->nullable();
            $table->string('road')->nullable();
            $table->string('house')->nullable();
            $table->string('house_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn([
                'division_id',
                'district_id',
                'thana_id',
                'post_office_id',
                'union_id',
                'ward_id',
                'road',
                'house',
                'house_bn',
            ]);
        });
    }
}
