<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
try { 
    echo json_encode(App\Models\License\License::with(['category', 'subcategory'])->get()); 
} catch (\Exception $e) { 
    echo $e->getMessage(); 
}
