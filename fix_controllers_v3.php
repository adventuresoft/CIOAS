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
    // Add empty arrays to prevent undefined variable errors in blade views
    $content = str_replace(
        "return view(", 
        "\$data[\"wards\"] = [];\n        \$data[\"ownership_types\"] = [];\n        return view(", 
        $content
    );
    file_put_contents($f, $content);
    echo "Fixed $f\n";
}

