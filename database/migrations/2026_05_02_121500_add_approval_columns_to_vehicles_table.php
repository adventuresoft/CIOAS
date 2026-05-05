<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalColumnsToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('vehicles')) {
            return;
        }

        Schema::table('vehicles', function (Blueprint $table) {
            if (! Schema::hasColumn('vehicles', 'status')) {
                $table->tinyInteger('status')->default(0)->comment('0 => Pending, 1 => Approved');
            }

            if (! Schema::hasColumn('vehicles', 'approved_by')) {
                $table->unsignedBigInteger('approved_by')->nullable();
            }

            if (! Schema::hasColumn('vehicles', 'approved_at')) {
                $table->timestamp('approved_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (! Schema::hasTable('vehicles')) {
            return;
        }

        Schema::table('vehicles', function (Blueprint $table) {
            if (Schema::hasColumn('vehicles', 'approved_at')) {
                $table->dropColumn('approved_at');
            }

            if (Schema::hasColumn('vehicles', 'approved_by')) {
                $table->dropColumn('approved_by');
            }

            if (Schema::hasColumn('vehicles', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
