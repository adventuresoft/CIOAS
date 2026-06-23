<?php
$files = [
    "app/Http/Controllers/HotelRestaurant/HotelRestaurantController.php",
    "app/Http/Controllers/Organization/OrganizationController.php",
    "app/Http/Controllers/HomeController.php",
    "app/Http/Controllers/LicenseController.php",
    "app/Http/Controllers/Frontend/FrontendController.php",
];
foreach($files as $f) {
    if(!file_exists($f)) continue;
    $content = file_get_contents($f);
    $content = preg_replace("/use App\\\\\\\\Models\\\\\\\\BasicSettings\\\\\\\\OrganizationOwnershipType;\\r?\\n/", "", $content);
    $content = preg_replace("/use App\\\\\\\\Models\\\\\\\\UnionWard;\\r?\\n/", "", $content);
    $content = preg_replace("/.*OrganizationOwnershipType::where.*/", "", $content);
    $content = preg_replace("/.*UnionWard::where.*/", "", $content);
    file_put_contents($f, $content);
    echo "Fixed $f\n";
}

