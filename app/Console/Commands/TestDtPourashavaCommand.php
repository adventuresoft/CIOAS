<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DataTables\BasicSettings\PourashavaDataTable;
use Illuminate\Http\Request;
use App\Models\Pourashava;

class TestDtPourashavaCommand extends Command
{
    protected $signature = 'test:dtpourashava';
    protected $description = 'Test Pourashava DataTable JSON output';

    public function handle(PourashavaDataTable $dataTable)
    {
        $request = Request::create('/basic-settings/pourashava', 'GET', [
            'draw' => 1,
            'start' => 0,
            'length' => 10,
            'search' => ['value' => '', 'regex' => 'false'],
            'order' => [
                ['column' => 2, 'dir' => 'asc']
            ],
            'columns' => [
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'searchable' => 'false', 'orderable' => 'false'],
                ['data' => 'district', 'name' => 'district.name', 'searchable' => 'false', 'orderable' => 'false'],
                ['data' => 'name', 'name' => 'name', 'searchable' => 'true', 'orderable' => 'true'],
                ['data' => 'bn_name', 'name' => 'bn_name', 'searchable' => 'true', 'orderable' => 'true'],
                ['data' => 'category', 'name' => 'category', 'searchable' => 'true', 'orderable' => 'true'],
                ['data' => 'status', 'name' => 'status', 'searchable' => 'true', 'orderable' => 'true'],
                ['data' => 'action', 'name' => 'action', 'searchable' => 'false', 'orderable' => 'false']
            ]
        ]);
        
        app()->instance('request', $request);

        try {
            $response = $dataTable->ajax();
            $this->info("Success! Output:");
            $this->line($response->getContent());
        } catch (\Exception $e) {
            $this->error("Exception: " . $e->getMessage());
            $this->error($e->getTraceAsString());
        }
    }
}
