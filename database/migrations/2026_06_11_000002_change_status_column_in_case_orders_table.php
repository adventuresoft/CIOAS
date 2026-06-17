<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Using raw SQL to avoid needing doctrine/dbal for a simple column change
        DB::statement('ALTER TABLE case_orders MODIFY status VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to integer
        DB::statement('ALTER TABLE case_orders MODIFY status INT NULL');
    }
};
