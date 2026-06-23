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
        Schema::table('lands', function (Blueprint $table) {
            $table->string('land_type')->after('id');
            $table->string('record_type')->after('land_type');
            $table->unsignedBigInteger('district_id')->nullable()->after('record_type');
            $table->unsignedBigInteger('upazila_id')->nullable()->after('district_id');
            $table->unsignedBigInteger('mouza_id')->nullable()->after('upazila_id');
            $table->integer('status')->default(0)->after('mouza_id')->comment('0=>Pending, 1=>Approved');
            $table->unsignedBigInteger('created_by')->nullable()->after('status');
            $table->unsignedBigInteger('approved_by')->nullable()->after('created_by');
            $table->timestamp('approved_at')->nullable()->after('approved_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->dropColumn([
                'land_type',
                'record_type',
                'district_id',
                'upazila_id',
                'mouza_id',
                'status',
                'created_by',
                'approved_by',
                'approved_at'
            ]);
        });
    }
};
