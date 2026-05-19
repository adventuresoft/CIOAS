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
        if (Schema::hasTable('application_froms') && !Schema::hasColumn('application_froms', 'current_section_id')) {
            Schema::table('application_froms', function (Blueprint $table) {
                $table->unsignedBigInteger('current_section_id')->nullable()->after('current_department_id');
            });
        }

        if (Schema::hasTable('application_assigns')) {
            Schema::table('application_assigns', function (Blueprint $table) {
                if (!Schema::hasColumn('application_assigns', 'from_section_id')) {
                    $table->unsignedBigInteger('from_section_id')->nullable()->after('from_department_id');
                }

                if (!Schema::hasColumn('application_assigns', 'to_section_id')) {
                    $table->unsignedBigInteger('to_section_id')->nullable()->after('to_department_id');
                }

                if (!Schema::hasColumn('application_assigns', 'note')) {
                    $table->text('note')->nullable()->after('assigned_by');
                }

                if (!Schema::hasColumn('application_assigns', 'is_received')) {
                    $table->boolean('is_received')->default(false)->after('note');
                }

                if (!Schema::hasColumn('application_assigns', 'received_by')) {
                    $table->unsignedBigInteger('received_by')->nullable()->after('is_received');
                }

                if (!Schema::hasColumn('application_assigns', 'received_at')) {
                    $table->timestamp('received_at')->nullable()->after('received_by');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('application_assigns')) {
            Schema::table('application_assigns', function (Blueprint $table) {
                $columns = [
                    'from_section_id',
                    'to_section_id',
                    'note',
                    'is_received',
                    'received_by',
                    'received_at',
                ];

                foreach ($columns as $column) {
                    if (Schema::hasColumn('application_assigns', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('application_froms') && Schema::hasColumn('application_froms', 'current_section_id')) {
            Schema::table('application_froms', function (Blueprint $table) {
                $table->dropColumn('current_section_id');
            });
        }
    }
};
