<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            if (!Schema::hasColumn('people', 'nid')) {
                $table->string('nid')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('people', 'mobile')) {
                $table->string('mobile')->nullable()->after('nid');
            }
            if (!Schema::hasColumn('people', 'email')) {
                $table->string('email')->nullable()->after('mobile');
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
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['nid', 'mobile', 'email']);
        });
    }
}
