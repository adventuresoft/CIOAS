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
        if (Schema::hasTable('application_froms')) {
            Schema::table('application_froms', function (Blueprint $table) {
                if (!Schema::hasColumn('application_froms', 'initial_approved_by')) {
                    $table->unsignedBigInteger('initial_approved_by')->nullable()->after('note');
                }
                if (!Schema::hasColumn('application_froms', 'initial_approved_at')) {
                    $table->timestamp('initial_approved_at')->nullable()->after('initial_approved_by');
                }
                if (!Schema::hasColumn('application_froms', 'initial_approval_note')) {
                    $table->text('initial_approval_note')->nullable()->after('initial_approved_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('application_froms')) {
            Schema::table('application_froms', function (Blueprint $table) {
                $columns = [
                    'initial_approved_by',
                    'initial_approved_at',
                    'initial_approval_note',
                ];

                foreach ($columns as $column) {
                    if (Schema::hasColumn('application_froms', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
