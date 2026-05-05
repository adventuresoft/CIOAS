<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToVehiclesTable extends Migration
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
            if (! Schema::hasColumn('vehicles', 'vehicle_type')) {
                $table->string('vehicle_type')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'vehicle_category')) {
                $table->string('vehicle_category')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'vehicle_model')) {
                $table->string('vehicle_model')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'make_year')) {
                $table->string('make_year')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'make_company')) {
                $table->string('make_company')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'ownership_type')) {
                $table->string('ownership_type')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'owner_id')) {
                $table->string('owner_id')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'owner_name')) {
                $table->string('owner_name')->nullable();
            }
            if (! Schema::hasColumn('vehicles', 'price')) {
                $table->double('price', 16, 2)->default(0);
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
            if (Schema::hasColumn('vehicles', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('vehicles', 'owner_name')) {
                $table->dropColumn('owner_name');
            }
            if (Schema::hasColumn('vehicles', 'owner_id')) {
                $table->dropColumn('owner_id');
            }
            if (Schema::hasColumn('vehicles', 'ownership_type')) {
                $table->dropColumn('ownership_type');
            }
            if (Schema::hasColumn('vehicles', 'make_company')) {
                $table->dropColumn('make_company');
            }
            if (Schema::hasColumn('vehicles', 'make_year')) {
                $table->dropColumn('make_year');
            }
            if (Schema::hasColumn('vehicles', 'vehicle_model')) {
                $table->dropColumn('vehicle_model');
            }
            if (Schema::hasColumn('vehicles', 'vehicle_category')) {
                $table->dropColumn('vehicle_category');
            }
            if (Schema::hasColumn('vehicles', 'vehicle_type')) {
                $table->dropColumn('vehicle_type');
            }
        });
    }
}
