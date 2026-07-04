<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$models = [
    \App\Models\ApplicationForm\ApplicationFrom::class,
    \App\Models\Land::class,
    \App\Models\Vehicle::class,
    \App\Models\Inventory\InventoryRequisition::class,
];

foreach ($models as $modelClass) {
    $model = new $modelClass();
    $table = $model->getTable();
    
    if (!Illuminate\Support\Facades\Schema::hasColumn($table, 'institute_id')) {
        Illuminate\Support\Facades\Schema::table($table, function (Illuminate\Database\Schema\Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
        });
        echo "Added institute_id to $table\n";
    } else {
        echo "institute_id already exists in $table\n";
    }
}
