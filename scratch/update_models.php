<?php
$models = [
    'app/Models/ApplicationForm/ApplicationFrom.php',
    'app/Models/Land.php',
    'app/Models/Vehicle.php',
    'app/Models/Inventory/InventoryRequisition.php',
];

foreach ($models as $modelFile) {
    $content = file_get_contents($modelFile);
    if (strpos($content, "'institute_id'") === false && strpos($content, '"institute_id"') === false) {
        // Find the $fillable array start
        $content = preg_replace('/(protected\s+\$fillable\s*=\s*\[)/', "$1\n        'institute_id',", $content);
        file_put_contents($modelFile, $content);
        echo "Updated fillable in $modelFile\n";
    } else {
        echo "institute_id already in fillable for $modelFile\n";
    }
}
