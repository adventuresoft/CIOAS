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
                if (!Schema::hasColumn('application_froms', 'approval_note')) {
                    $table->text('approval_note')->nullable()->after('note');
                }

                if (!Schema::hasColumn('application_froms', 'approved_by')) {
                    $table->unsignedBigInteger('approved_by')->nullable()->after('approval_note');
                }

                if (!Schema::hasColumn('application_froms', 'approved_at')) {
                    $table->timestamp('approved_at')->nullable()->after('approved_by');
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
                    'approval_note',
                    'approved_by',
                    'approved_at',
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
