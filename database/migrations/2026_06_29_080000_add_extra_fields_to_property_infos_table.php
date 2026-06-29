<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('property_infos', 'land_price')) {
                $table->double('land_price', 16, 2)->default(0.00)->after('land_quantity');
            }
            if (!Schema::hasColumn('property_infos', 'house_information')) {
                $table->text('house_information')->nullable()->after('house_price');
            }
            if (!Schema::hasColumn('property_infos', 'land_information')) {
                $table->text('land_information')->nullable()->after('land_price');
            }
            if (!Schema::hasColumn('property_infos', 'diamond_information')) {
                $table->text('diamond_information')->nullable()->after('diamond_price');
            }
            if (!Schema::hasColumn('property_infos', 'gold_information')) {
                $table->text('gold_information')->nullable()->after('gold_price');
            }
            if (!Schema::hasColumn('property_infos', 'silver_information')) {
                $table->text('silver_information')->nullable()->after('silver_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_infos', function (Blueprint $table) {
            $table->dropColumn([
                'land_price',
                'house_information',
                'land_information',
                'diamond_information',
                'gold_information',
                'silver_information'
            ]);
        });
    }
};
