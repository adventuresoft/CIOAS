<?php
$models = [
    'app/Models/PersonGunApplication.php',
    'app/Models/OrgGunApplication.php',
    'app/Models/OtherOrgGunApplication.php',
];

foreach ($models as $modelFile) {
    if (file_exists($modelFile)) {
        $content = file_get_contents($modelFile);
        if (strpos($content, "'institute_id'") === false && strpos($content, '"institute_id"') === false) {
            // Find the $fillable array start
            $content = preg_replace('/(protected\s+\$fillable\s*=\s*\[)/', "$1\n        'institute_id',", $content);
            file_put_contents($modelFile, $content);
            echo "Updated fillable in $modelFile\n";
        } else {
            echo "institute_id already in fillable for $modelFile\n";
        }
    } else {
        echo "Model file $modelFile does not exist\n";
    }
}
