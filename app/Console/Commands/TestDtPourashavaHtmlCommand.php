<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\DataTables\BasicSettings\PourashavaDataTable;

class TestDtPourashavaHtmlCommand extends Command
{
    protected $signature = 'test:dtpourashavahtml';
    public function handle(PourashavaDataTable $dataTable)
    {
        $this->line($dataTable->html()->table()->toHtml());
        $this->line($dataTable->html()->scripts()->toHtml());
    }
}
