<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class FixPermissionsTablePrimaryKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::statement('ALTER TABLE permissions ADD PRIMARY KEY (id)');
        } catch (\Exception $e) {
            // Primary key might already exist
        }
        
        DB::statement('ALTER TABLE permissions MODIFY id bigint(20) unsigned NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE permissions MODIFY id bigint(20) unsigned NOT NULL');
        try {
            DB::statement('ALTER TABLE permissions DROP PRIMARY KEY');
        } catch (\Exception $e) {
            // Ignore
        }
    }
}
