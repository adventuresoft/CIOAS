<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSameAsPermanentToAddressInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('address_infos', 'is_same_as_permanent')) {
                $table->boolean('is_same_as_permanent')->default(0)->after('user_id');
            }
            if (!Schema::hasColumn('address_infos', 'permanent_house_bn')) {
                $table->string('permanent_house_bn')->nullable()->after('permanent_house');
            }
            if (!Schema::hasColumn('address_infos', 'present_house_bn')) {
                $table->string('present_house_bn')->nullable()->after('present_house');
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
        Schema::table('address_infos', function (Blueprint $table) {
            if (Schema::hasColumn('address_infos', 'is_same_as_permanent')) {
                $table->dropColumn('is_same_as_permanent');
            }
            if (Schema::hasColumn('address_infos', 'permanent_house_bn')) {
                $table->dropColumn('permanent_house_bn');
            }
            if (Schema::hasColumn('address_infos', 'present_house_bn')) {
                $table->dropColumn('present_house_bn');
            }
        });
    }
}
