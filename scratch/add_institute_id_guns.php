<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$models = [
    \App\Models\PersonGunApplication::class,
    \App\Models\OrgGunApplication::class,
    \App\Models\OtherOrgGunApplication::class,
];

foreach ($models as $modelClass) {
    if (class_exists($modelClass)) {
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
    } else {
        echo "Model $modelClass does not exist\n";
    }
}
