<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$tables = ['person_gun_applications', 'org_gun_applications', 'other_org_gun_applications'];
foreach($tables as $table) { 
    $cols = Illuminate\Support\Facades\Schema::getColumnListing($table); 
    echo $table . ': ' . (in_array('institute_id', $cols) ? 'YES' : 'NO') . PHP_EOL; 
}
