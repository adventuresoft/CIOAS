<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->string('dag_no')->nullable()->after('mouza_id');
            $table->string('khatian_no')->nullable()->after('dag_no');
            $table->string('recorded_owner_name')->nullable()->after('khatian_no');
            $table->unsignedBigInteger('recorded_class')->nullable()->after('recorded_owner_name');
            $table->unsignedBigInteger('actual_class')->nullable()->after('recorded_class');
            $table->decimal('total_land', 12, 4)->nullable()->after('actual_class');
            $table->decimal('land_amount', 12, 4)->nullable()->after('total_land');
            $table->string('possession_status')->nullable()->after('land_amount');
            $table->string('case_no')->nullable()->after('possession_status');
            $table->string('gazette_no')->nullable()->after('case_no');
            $table->text('remarks')->nullable()->after('gazette_no');

            // details JSON column was already dropped in a prior migration
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->dropColumn([
                'dag_no','khatian_no','recorded_owner_name','recorded_class',
                'actual_class','total_land','land_amount','possession_status',
                'case_no','gazette_no','remarks',
            ]);
            $table->json('details')->nullable()->after('locations');
        });
    }
};
