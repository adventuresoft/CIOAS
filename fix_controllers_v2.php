<?php
$files = [
    "app/Http/Controllers/HotelRestaurant/HotelRestaurantController.php",
    "app/Http/Controllers/Organization/OrganizationController.php",
    "app/Http/Controllers/HomeController.php",
    "app/Http/Controllers/License/LicenseController.php",
];
foreach($files as $f) {
    if(!file_exists($f)) continue;
    $content = file_get_contents($f);
    $lines = explode("\n", $content);
    $newLines = [];
    foreach($lines as $line) {
        if(strpos($line, "OrganizationOwnershipType") !== false) continue;
        if(strpos($line, "UnionWard") !== false) continue;
        $newLines[] = $line;
    }
    file_put_contents($f, implode("\n", $newLines));
    echo "Fixed $f\n";
}

