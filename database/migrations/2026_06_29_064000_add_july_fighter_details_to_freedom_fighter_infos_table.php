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
            $table->string('july_incident_location')->nullable()->after('july_type_id');
            $table->string('july_injury_details')->nullable()->after('july_incident_location');
            $table->text('july_contribution_description')->nullable()->after('july_injury_details');
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
                'july_incident_location',
                'july_injury_details',
                'july_contribution_description',
            ]);
        });
    }
};
