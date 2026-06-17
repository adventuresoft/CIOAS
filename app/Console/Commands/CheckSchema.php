<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
class CheckSchema extends Command {
    protected $signature = 'check:schema';
    public function handle() {
        $cols = Schema::getColumnListing('inventory_work_order_items');
        $this->info(implode(', ', $cols));
    }
}
