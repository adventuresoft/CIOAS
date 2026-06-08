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
        Schema::table('staffs', function (Blueprint $table) {
            $table->string('bn_name')->nullable()->after('staff_id');
            $table->date('date_of_birth')->nullable()->after('bn_name');
            $table->string('birth_place')->nullable()->after('date_of_birth');
            $table->unsignedBigInteger('district_id')->nullable()->after('birth_place');
            $table->unsignedBigInteger('country_id')->nullable()->after('district_id');
            $table->tinyInteger('gender')->nullable()->after('country_id');
            $table->unsignedBigInteger('religion_id')->nullable()->after('gender');
            $table->string('blood_group')->nullable()->after('religion_id');
            $table->string('approved_id')->nullable()->after('blood_group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            $table->dropColumn([
                'bn_name',
                'date_of_birth',
                'birth_place',
                'district_id',
                'country_id',
                'gender',
                'religion_id',
                'blood_group',
            ]);
        });
    }
};
