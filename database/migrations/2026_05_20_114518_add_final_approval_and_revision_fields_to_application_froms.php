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
                if (!Schema::hasColumn('application_froms', 'final_approved_by')) {
                    $table->unsignedBigInteger('final_approved_by')->nullable()->after('approved_at');
                }
                if (!Schema::hasColumn('application_froms', 'final_approved_at')) {
                    $table->timestamp('final_approved_at')->nullable()->after('final_approved_by');
                }
                if (!Schema::hasColumn('application_froms', 'final_approval_note')) {
                    $table->text('final_approval_note')->nullable()->after('final_approved_at');
                }
                if (!Schema::hasColumn('application_froms', 'revision_note')) {
                    $table->text('revision_note')->nullable()->after('final_approval_note');
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
                    'final_approved_by',
                    'final_approved_at',
                    'final_approval_note',
                    'revision_note',
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
