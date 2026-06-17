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
        Schema::table('inventory_work_orders', function (Blueprint $table) {
            $table->date('validity_date')->nullable()->after('application_date');
            $table->date('delivery_date')->nullable()->after('validity_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_work_orders', function (Blueprint $table) {
            $table->dropColumn(['validity_date', 'delivery_date']);
        });
    }
};
