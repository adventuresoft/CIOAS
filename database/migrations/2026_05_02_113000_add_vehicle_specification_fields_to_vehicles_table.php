<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVehicleSpecificationFieldsToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('vehicles')) {
            return;
        }

        Schema::table('vehicles', function (Blueprint $table) {
            if (! Schema::hasColumn('vehicles', 'engine_number')) {
                $table->string('engine_number')->nullable()->after('price');
            }
            if (! Schema::hasColumn('vehicles', 'chassis_number')) {
                $table->string('chassis_number')->nullable()->after('engine_number');
            }
            if (! Schema::hasColumn('vehicles', 'tyre_number')) {
                $table->string('tyre_number')->nullable()->after('chassis_number');
            }
            if (! Schema::hasColumn('vehicles', 'hp_cc')) {
                $table->string('hp_cc')->nullable()->after('tyre_number');
            }
            if (! Schema::hasColumn('vehicles', 'seat_capacity')) {
                $table->string('seat_capacity')->nullable()->after('hp_cc');
            }
            if (! Schema::hasColumn('vehicles', 'height')) {
                $table->string('height')->nullable()->after('seat_capacity');
            }
            if (! Schema::hasColumn('vehicles', 'width')) {
                $table->string('width')->nullable()->after('height');
            }
            if (! Schema::hasColumn('vehicles', 'tyre_size')) {
                $table->string('tyre_size')->nullable()->after('width');
            }
            if (! Schema::hasColumn('vehicles', 'color')) {
                $table->string('color')->nullable()->after('tyre_size');
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
        if (! Schema::hasTable('vehicles')) {
            return;
        }

        Schema::table('vehicles', function (Blueprint $table) {
            if (Schema::hasColumn('vehicles', 'color')) {
                $table->dropColumn('color');
            }
            if (Schema::hasColumn('vehicles', 'tyre_size')) {
                $table->dropColumn('tyre_size');
            }
            if (Schema::hasColumn('vehicles', 'width')) {
                $table->dropColumn('width');
            }
            if (Schema::hasColumn('vehicles', 'height')) {
                $table->dropColumn('height');
            }
            if (Schema::hasColumn('vehicles', 'seat_capacity')) {
                $table->dropColumn('seat_capacity');
            }
            if (Schema::hasColumn('vehicles', 'hp_cc')) {
                $table->dropColumn('hp_cc');
            }
            if (Schema::hasColumn('vehicles', 'tyre_number')) {
                $table->dropColumn('tyre_number');
            }
            if (Schema::hasColumn('vehicles', 'chassis_number')) {
                $table->dropColumn('chassis_number');
            }
            if (Schema::hasColumn('vehicles', 'engine_number')) {
                $table->dropColumn('engine_number');
            }
        });
    }
}
