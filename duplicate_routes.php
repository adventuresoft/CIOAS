<?php
$file = __DIR__ . '/routes/web.php';
$content = file_get_contents($file);

$startStr = "Route::resource('people', PeopleController::class);";
$endStr = "Route::get('/people/property-delete/{proID}', [ PropertyInfoController::class, 'destroy' ])->name('people.propertyDelete');";

$start = strpos($content, $startStr);
$end = strpos($content, $endStr) + strlen($endStr);

if ($start !== false && $end !== false) {
    $peopleBlock = substr($content, $start, $end - $start);
    $staffBlock = str_replace('people', 'staff', $peopleBlock);
    
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
        $staffBlock = str_replace($old, $new, $staffBlock);
    }
    
    $useBlock = "\n// Staff Controllers\n";
    foreach ($controllers as $new) {
        if (!str_contains($content, "use App\Http\Controllers\\$new;")) {
            $useBlock .= "use App\Http\Controllers\\$new;\n";
        }
    }
    
    // Safely insert use block using str_replace so we don't mess up indices
    $content = str_replace('use App\Http\Controllers\AddressInfoController;', 'use App\Http\Controllers\AddressInfoController;' . $useBlock, $content);

    // Insert the new block right after the people block
    $content = str_replace($endStr, $endStr . "\n\n    // Staff Routes\n    " . $staffBlock, $content);
    
    // Also duplicate peopleapprovedlist
    $apprStart = strpos($content, "Route::get('/peopleapprovedlist', [ PeopleController::class, 'approvedlist' ])->name('peopleapprovedlist');");
    if ($apprStart !== false) {
        $apprEnd = strpos($content, "->name('peopleapprovedlist');") + strlen("->name('peopleapprovedlist');");
        $apprBlock = substr($content, $apprStart, $apprEnd - $apprStart);
        $staffApprBlock = str_replace('peopleapprovedlist', 'staffapprovedlist', $apprBlock);
        $staffApprBlock = str_replace('PeopleController', 'StaffController', $staffApprBlock);
        
        $content = str_replace("->name('peopleapprovedlist');", "->name('peopleapprovedlist');\n    " . $staffApprBlock, $content);
    }
    
    // Also duplicate people/approve/{id}
    $approveRoute = "Route::get('/people/approve/{id}', [ PeopleController::class, 'approve' ])->name('people.approve');";
    $staffApproveRoute = "Route::get('/staff/approve/{id}', [ StaffController::class, 'approve' ])->name('staff.approve');";
    if (strpos($content, $approveRoute) !== false) {
        $content = str_replace($approveRoute, $approveRoute . "\n    " . $staffApproveRoute, $content);
    } else {
        // sometimes formatting is slightly different, wait, in grep_search it showed:
        // Route::get('/people/approve/{id}', [ PeopleController::class, 'approve' ])
        $approveStart = strpos($content, "Route::get('/people/approve/{id}'");
        if ($approveStart !== false) {
            $approveEnd = strpos($content, "->name('people.approve');", $approveStart) + strlen("->name('people.approve');");
            $approveBlock = substr($content, $approveStart, $approveEnd - $approveStart);
            $staffApproveBlock = str_replace('people', 'staff', $approveBlock);
            $staffApproveBlock = str_replace('PeopleController', 'StaffController', $staffApproveBlock);
            $content = str_replace($approveBlock, $approveBlock . "\n    " . $staffApproveBlock, $content);
        }
    }

    file_put_contents($file, $content);
    echo "Routes updated\n";
} else {
    echo "Could not find blocks\n";
}
