<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$tables = Illuminate\Support\Facades\DB::select('SHOW TABLES');
foreach($tables as $t) {
    $tarr = (array)$t;
    $name = array_values($tarr)[0];
    if (strpos($name, 'gun') !== false) echo $name . PHP_EOL;
}
