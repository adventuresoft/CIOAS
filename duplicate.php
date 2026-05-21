<?php
$viewsDir = __DIR__ . '/resources/views/backend/pages/staff';
$files = array_merge(glob("$viewsDir/*.blade.php"), glob("$viewsDir/tabs/*.blade.php"));

foreach ($files as $file) {
    $content = file_get_contents($file);
    // Replace routes and folder references
    $content = str_replace('people.', 'staff.', $content);
    $content = str_replace("peopleInfo", "staffInfo", $content);
    $content = str_replace("People Information", "Staff Information", $content);
    $content = str_replace("People Create", "Staff Create", $content);
    $content = str_replace("backend.pages.people", "backend.pages.staff", $content);
    
    // Replace controllers in the tabs
    $content = str_replace("PeopleController", "StaffController", $content);
    
    // Some titles
    $content = str_replace(">People<", ">Staff<", $content);
    $content = str_replace("'People'", "'Staff'", $content);
    
    file_put_contents($file, $content);
}

// Now duplicate controllers
$controllers = [
    'PeopleController' => 'StaffController',
    'FamilyInfoController' => 'StaffFamilyInfoController',
    'AddressInfoController' => 'StaffAddressInfoController',
    'EducationalInfoController' => 'StaffEducationalInfoController',
    'ProfessionalInfoController' => 'StaffProfessionalInfoController',
    'FinancialInfoController' => 'StaffFinancialInfoController',
    'PropertyInfoController' => 'StaffPropertyInfoController',
    'DisabilityInfoController' => 'StaffDisabilityInfoController',
    'FreedomFighterInfoController' => 'StaffFreedomFighterInfoController',
    'HealthInfoController' => 'StaffHealthInfoController',
    'ParentInfoController' => 'StaffParentInfoController',
];

foreach ($controllers as $old => $new) {
    $oldFile = __DIR__ . "/app/Http/Controllers/$old.php";
    if (!file_exists($oldFile)) continue;
    
    $content = file_get_contents($oldFile);
    $content = str_replace("class $old", "class $new", $content);
    $content = str_replace("people.", "staff.", $content);
    $content = str_replace("backend.pages.people", "backend.pages.staff", $content);
    $content = str_replace("peopleapprovedlist", "staffapprovedlist", $content);
    $content = str_replace("people_constant_option", "people_constant_option", $content); // keep this
    
    if ($old == 'PeopleController') {
        // In store method, set is_staff = 1
        $content = str_replace("\$people->blood_group   = \$request->blood_group;", "\$people->blood_group   = \$request->blood_group;\n                    \$people->is_staff = 1;", $content);
        // And for index query, filter by is_staff = 1
        $content = str_replace("->whereNull('approved_id');", "->whereNull('approved_id')->where('is_staff', 1);", $content);
        $content = str_replace("->whereNotNull('approved_id');", "->whereNotNull('approved_id')->where('is_staff', 1);", $content);
    }
    
    file_put_contents(__DIR__ . "/app/Http/Controllers/$new.php", $content);
}

echo "Done\n";
