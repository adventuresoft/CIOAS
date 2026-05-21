<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAccountBalanceInFinancialInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `financial_infos` MODIFY COLUMN `account_balance` DECIMAL(20, 2) NOT NULL DEFAULT 0.00");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `financial_infos` MODIFY COLUMN `account_balance` DOUBLE(16, 2) NOT NULL DEFAULT 0.00");
    }
}
