<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $dt = new \App\DataTables\BasicSettings\LicenseCategoryDataTable();
    echo $dt->html()->scripts();
    echo "\n\nHTML IS OK\n\n";
    
    // Test data loading
    $request = Illuminate\Http\Request::create('/dashboard/basic-settings/license-category', 'GET', ['draw' => 1]);
    app()->instance('request', $request);
    
    $query = App\Models\License\LicenseCategory::query();
    $data = $dt->dataTable($query)->toJson();
    echo substr($data->getContent(), 0, 500);

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}
