<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstitutionalFieldsToVehiclesTable extends Migration
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
            if (! Schema::hasColumn('vehicles', 'institutional_name')) {
                $table->string('institutional_name')->nullable()->after('owner_name');
            }

            if (! Schema::hasColumn('vehicles', 'trade_license')) {
                $table->string('trade_license')->nullable()->after('institutional_name');
            }

            if (! Schema::hasColumn('vehicles', 'institutional_address')) {
                $table->string('institutional_address', 500)->nullable()->after('trade_license');
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
            if (Schema::hasColumn('vehicles', 'institutional_address')) {
                $table->dropColumn('institutional_address');
            }

            if (Schema::hasColumn('vehicles', 'trade_license')) {
                $table->dropColumn('trade_license');
            }

            if (Schema::hasColumn('vehicles', 'institutional_name')) {
                $table->dropColumn('institutional_name');
            }
        });
    }
}
