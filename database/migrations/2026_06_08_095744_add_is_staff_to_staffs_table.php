<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('staffs', function (Blueprint $table) {
            $table->tinyInteger('is_staff')->default(2)->after('staff_id'); // 1=approved, 2=pending
        });
    }

    public function down()
    {
        Schema::table('staffs', function (Blueprint $table) {
            $table->dropColumn('is_staff');
        });
    }
};
