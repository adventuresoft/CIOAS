<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('freedom_fighter_infos', function (Blueprint $table) {
            $table->boolean('is_july_fighter')->default(false)->after('commander_name');
            $table->bigInteger('july_type_id')->nullable()->after('is_july_fighter');
            $table->bigInteger('july_area_id')->nullable()->after('july_type_id');
            $table->bigInteger('july_designation_id')->nullable()->after('july_area_id');
            $table->string('july_fighter_id')->nullable()->after('july_designation_id');
            $table->string('july_commander_name')->nullable()->after('july_fighter_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('freedom_fighter_infos', function (Blueprint $table) {
            $table->dropColumn([
                'is_july_fighter',
                'july_type_id',
                'july_area_id',
                'july_designation_id',
                'july_fighter_id',
                'july_commander_name',
            ]);
        });
    }
};
