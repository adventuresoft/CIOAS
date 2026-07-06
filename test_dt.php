<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
try { 
    $request = Illuminate\Http\Request::create('/dashboard/license', 'GET', ['draw' => 1, 'start' => 0, 'length' => 10, 'search' => ['value' => '']]);
    $app->instance('request', $request);
    $dt = app(App\DataTables\License\LicenseDataTable::class);
    echo json_encode($dt->ajax()->getContent()); 
} catch (\Exception $e) { 
    echo $e->getMessage(); 
}
