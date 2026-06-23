<?php

use App\Http\Controllers\AddressInfoController;
// Staff Controllers
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffFamilyInfoController;
use App\Http\Controllers\StaffAddressInfoController;
use App\Http\Controllers\StaffEducationalInfoController;
use App\Http\Controllers\StaffProfessionalInfoController;
use App\Http\Controllers\StaffFinancialInfoController;
use App\Http\Controllers\StaffPropertyInfoController;
use App\Http\Controllers\StaffDisabilityInfoController;
use App\Http\Controllers\StaffFreedomFighterInfoController;
use App\Http\Controllers\StaffHealthInfoController;
use App\Http\Controllers\StaffParentInfoController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;

use App\Http\Controllers\CityCorporationController;
use App\Http\Controllers\BasicSettings\MarketCategoryController;
use App\Http\Controllers\BasicSettings\MarketOwnershipTypeController;
use App\Http\Controllers\BasicSettings\MarketTypeController;
use App\Http\Controllers\BasicSettings\OrganizationClassController;
use App\Http\Controllers\BasicSettings\VehicleCategoryController;
use App\Http\Controllers\BasicSettings\VehicleSubCategoryController;
use App\Http\Controllers\BasicSettings\VehicleTypeController;
use App\Http\Controllers\BasicSettings\VillageController;
use App\Http\Controllers\BasicSettings\DistrictController as BasicDistrictController;
use App\Http\Controllers\BasicSettings\ThanaController as BasicThanaController;
use App\Http\Controllers\BasicSettings\MouzaController as BasicMouzaController;
use App\Http\Controllers\BasicSettings\UpazilaController as BasicUpazilaController;
use App\Http\Controllers\UnionController as BasicUnionController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\Certificate\BirthCertificateController;
use App\Http\Controllers\Certificate\CharacterCertificateController;
use App\Http\Controllers\Certificate\CitizenCertificateController;
use App\Http\Controllers\Certificate\DeathCertificateController;
use App\Http\Controllers\Certificate\UnmarriedCertificateController;
use App\Http\Controllers\Certificate\MarriedCertificateController;
use App\Http\Controllers\Certificate\RemarriedCertificateController;
use App\Http\Controllers\Certificate\LandlessCertificateController;
use App\Http\Controllers\Certificate\NameCertificateController;
use App\Http\Controllers\Certificate\YearlyIncomeCertificateController;
use App\Http\Controllers\Certificate\DisabilityCertificateController;

use App\Http\Controllers\Certificate\GuardianCertificateController;
use App\Http\Controllers\Certificate\ResidentialCertificateController;
use App\Http\Controllers\Certificate\PermanentCitizenCertificateController;
use App\Http\Controllers\Certificate\AgeCertificateController;
use App\Http\Controllers\Certificate\FinancialInstabilityCertificateController;

use App\Http\Controllers\Certificate\OrphanCertificateController;
use App\Http\Controllers\Certificate\ChildlessCertificateController;
use App\Http\Controllers\Certificate\NidCorrectionCertificateController;
use App\Http\Controllers\Certificate\VoterListCertificateController;
use App\Http\Controllers\Certificate\VoterAreaCertificateController;


use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisabilityInfoController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PourashavaController;
use App\Http\Controllers\DivorceController;
use App\Http\Controllers\EducationalInfoController;
use App\Http\Controllers\FamilyInfoController;
use App\Http\Controllers\FinancialInfoController;
use App\Http\Controllers\FreedomFighterInfoController;
use App\Http\Controllers\HealthInfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\HouseOwnershipController;
use App\Http\Controllers\InstituteCategoryController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\Inventory\QuotationController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\InstitutionalAdminController;
use App\Http\Controllers\InstituteTypeController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\MarriageController;

use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProfessionalInfoController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\PropertyInfoController;
use App\Http\Controllers\RoadController;
use App\Http\Controllers\Tax\TaxController;
use App\Http\Controllers\Tax\TaxRateController;
use App\Http\Controllers\Tax\TaxYearController;
use App\Http\Controllers\ThanaController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ChairmanController;
use App\Http\Controllers\CounsilorController;
use App\Http\Controllers\SuccessionController;
use App\Http\Controllers\CertificateVerifyController;
use App\Http\Controllers\PostOfficeController;
use Illuminate\Support\Facades\Route;

// HotelRestaurantController
use App\Http\Controllers\HotelRestaurant\HotelRestaurantController;
use App\Http\Controllers\HotelRestaurant\HotelCategoryController;
use App\Http\Controllers\HotelRestaurant\HotelSubCategoryController;
use App\Http\Controllers\HotelRestaurant\HotelRestaurantOwnershipController;
use App\Http\Controllers\License\LicenseController;
use App\Http\Controllers\License\LicenseCategoryController;
use App\Http\Controllers\License\LicenseSubCategoryController;

use App\Http\Controllers\Backend\MisCaseController;

use App\Http\Controllers\Backend\CaseOrderController;

use App\Http\Controllers\Backend\PersonGunLicenseController;
use App\Http\Controllers\Backend\OrgGunLicenseController;

// DepartmentController
use App\Http\Controllers\Departments\DepartmentController;
use App\Http\Controllers\Departments\DepartmentSectionController;



// Application Form

use App\Http\Controllers\ApplicationForm\ApplicationFormController;
use App\Http\Controllers\ApplicationForm\InquiryFormController;

Route::get('/inquiry', [InquiryFormController::class, 'index'])->name('inquiry.index');
Route::post('/inquiry', [InquiryFormController::class, 'store'])->name('inquiry.store');



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/miscase-list', [HomeController::class, 'miscaseList'])->name('frontend.miscase.index');
Route::get('/license-apply', [HomeController::class, 'licenseForm'])->name('frontend.license.create');
Route::post('/license-apply/store', [HomeController::class, 'licenseStore'])->name('frontend.license.store');
Route::get('/license-apply/success/{application_id}', [HomeController::class, 'licenseSuccess'])->name('frontend.license.success');

// Public Hotel & Restaurant
Route::get('/hotel-restaurant-apply', [HomeController::class, 'hotelRestaurantForm'])->name('frontend.hotel-restaurant.create');
Route::post('/hotel-restaurant-apply/store', [HomeController::class, 'hotelRestaurantStore'])->name('frontend.hotel-restaurant.store');
Route::get('/hotel-restaurant-apply/success/{application_id}', [HomeController::class, 'hotelRestaurantSuccess'])->name('frontend.hotel-restaurant.success');

// Public Gun License
Route::get('/gun-license-apply', [HomeController::class, 'gunLicenseSelect'])->name('frontend.gun-license.select');
Route::get('/gun-license-apply/person', [HomeController::class, 'personGunForm'])->name('frontend.gun-license.person.create');
Route::post('/gun-license-apply/person/store', [HomeController::class, 'personGunStore'])->name('frontend.gun-license.person.store');
Route::get('/gun-license-apply/person/success/{application_id}', [HomeController::class, 'personGunSuccess'])->name('frontend.gun-license.person.success');

Route::get('/gun-license-apply/org', [HomeController::class, 'orgGunForm'])->name('frontend.gun-license.org.create');
Route::post('/gun-license-apply/org/store', [HomeController::class, 'orgGunStore'])->name('frontend.gun-license.org.store');
Route::get('/gun-license-apply/org/success/{application_id}', [HomeController::class, 'orgGunSuccess'])->name('frontend.gun-license.org.success');

Route::get('/gun-license-apply/other-org', [HomeController::class, 'otherOrgGunForm'])->name('frontend.gun-license.other-org.create');
Route::post('/gun-license-apply/other-org/store', [HomeController::class, 'otherOrgGunStore'])->name('frontend.gun-license.other-org.store');
Route::get('/gun-license-apply/other-org/success/{application_id}', [HomeController::class, 'otherOrgGunSuccess'])->name('frontend.gun-license.other-org.success');

Route::get('/sms', function () {
    return view('frontend.pages.sms');
});

Route::get('test-api', [HomeController::class, 'testHttpRequest']);

// Login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-check', [LoginController::class, 'loginCheck'])->name('login.check');

// Register
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register/store', [LoginController::class, 'registerStore'])->name('register.store');
Route::get('/profile', [LoginController::class, 'profile'])->name('profile')->middleware('auth');

// Application
Route::prefix('application')->name('application.')->group(function () {
    Route::get('/', [ApplicationController::class, 'create'])->name('create');
    Route::post('store', [ApplicationController::class, 'store'])->name('store');
    Route::get('success/{system_id}', [ApplicationController::class, 'success'])->name('success');
});


/* permisison */
// Role route start
Route::controller(RoleController::class)->group(function () {
    Route::get('role', 'index')->name('role.index');
    Route::post('role', 'store')->name('role.store');
    Route::get('role/{id}/edit', 'edit')->name('role.edit');
    Route::patch('role/{id}', 'update')->name('role.update');
    Route::delete('role/{id}', 'destroy')->name('role.destroy');
});

// Permission route start
Route::controller(PermissionController::class)->group(function () {
    Route::get('permission', 'index')->name('permission.index');
    Route::post('permission', 'store')->name('permission.store');
    Route::get('permission/{id}/edit', 'edit')->name('permission.edit');
    Route::patch('permission/{id}', 'update')->name('permission.update');
    Route::delete('permission/{id}', 'destroy')->name('permission.destroy');
});

// Role Permission route start
Route::controller(RolePermissionController::class)->group(function () {
    Route::get('rolepermission', 'index')->name('rolepermission.index');
    Route::post('rolepermission', 'store')->name('rolepermission.store');
    Route::get('rolepermission/{role_id}/edit/{permission_id}', 'edit')->name('rolepermission.edit');
    Route::patch('rolepermission/{id}', 'update')->name('rolepermission.update');

    Route::post('rolepermission/destroy', 'destroy')->name('rolepermission.destroy');
});

// Role User route start
Route::controller(RoleUserController::class)->group(function () {
    Route::get('roleuser', 'index')->name('roleuser.index');
    Route::get('roleuser/create', 'create')->name('roleuser.create');
    Route::post('roleuser', 'store')->name('roleuser.store');
    Route::get('roleuser/{role_id}/edit/{user_id}', 'edit')->name('roleuser.edit');
    Route::patch('roleuser/{id}', 'update')->name('roleuser.update');
    Route::post('roleuser/roleusersoft', 'roleusersoft')->name('roleuser.roleusersoft');

});

// User Permission route start
Route::controller(UserPermissionController::class)->group(function () {
    Route::get('userper', 'index')->name('userper.index');
    Route::get('userper/create', 'create')->name('userper.create');
    Route::post('userper', 'store')->name('userper.store');
    Route::get('userper/{model_id}/edit/{permission_id}', 'edit')->name('userper.edit');
    Route::patch('userper/{id}', 'update')->name('userper.update');
    Route::post('userper/delete', 'destroy')->name('userper.destroy');
});

Route::resource('user', UserController::class);

Route::get('/certificate/verify', [CertificateVerifyController::class, 'index'])->name('certificate.verify');
Route::post('/certificate/verify/search', [CertificateVerifyController::class, 'search'])->name('certificate.verify.search');

/* end permission */
Route::post('/load-project-type-content', [ProjectTypeController::class, 'projectTypeContent'])->name('projectTypeContent');
Route::post('/backend/load-project-type-content', [ProjectTypeController::class, 'backendProjectTypeContent'])->name('backendProjectTypeContent');

// Find Dependencies
Route::get('/get-districts-by-division/{divisionID}', [DistrictController::class, 'districtsByDivision']);
Route::get('/get-thanas-by-district/{districtID}', [ThanaController::class, 'thanasByDistrict']);
Route::get('/get-upazilas-by-district/{districtID}', [UpazilaController::class, 'upazilasByDistrict']);
Route::get('/get-pourashava-by-district/{districtID}', [PourashavaController::class, 'pourashavaByDistrict']);
Route::get('/get-postOffice-by-thana/{thanaID}', [PostOfficeController::class, 'postOfficeByThana']);
// Route::get('/get-word-by-union/{unionID}', ...); // Removed: UnionWardController deleted
Route::get('/get-city-corporation-by-district/{districtID}', [CityCorporationController::class, 'cityByDistrict']);

Route::get('/get-unions-by-thana/{thanaID}', [UnionController::class, 'unionsByThana']);
Route::get('/get-villages-by-union/{unionID}', [VillageController::class, 'villagesByUnion']);
Route::get('/get-villages-by-type/{ID}/{type}', [VillageController::class, 'villagesByUnion']);
Route::get('/get-mouzas-by-thana/{thanaID}', [BasicMouzaController::class, 'mouzasByThana']);
// Route::get('/get-areas-by-village/{villageID}', ...); // Removed: VillageAreaController deleted
Route::get('/get-houses-by-village-area/{areaID}', [HouseController::class, 'getHouseByArea']);


Route::get('/house-single-ownership-form', [HouseOwnershipController::class, 'loadOwnershipForm']);
Route::get('/house-ownership-remove/{id}', [HouseOwnershipController::class, 'destroy']);

Route::get('/hotel-subcategory-options/{id}', [HotelSubCategoryController::class, 'options']);
Route::get('/license-subcategory-options/{id}', [LicenseSubCategoryController::class, 'options']);
Route::get('/house-options/{id}', [HouseController::class, 'options']);

// Admin with Auth
Route::get('get-people-by-union/{union_id}', [ChairmanController::class, 'getPeopleByUnion']);
Route::get('changeMember/{councilor_member_id}', [ChairmanController::class, 'changeMember'])->name('chairman.changeMember');
Route::post('/councilorUpdate', [ChairmanController::class, "councilorUpdate"])->name('chairman.councilorUpdate');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('people', PeopleController::class);

    Route::get('/people/family/{userID}', [FamilyInfoController::class, 'create'])->name('people.family');
    Route::post('/people/family-store', [FamilyInfoController::class, 'store'])->name('people.familyStore');

    Route::get('/people/address/{userID}', [AddressInfoController::class, 'create'])->name('people.address');
    Route::post('/people/address-store', [AddressInfoController::class, 'store'])->name('people.addressStore');

    Route::get('/people/health/{userID}', [HealthInfoController::class, 'create'])->name('people.health');
    Route::post('/people/health-store', [HealthInfoController::class, 'store'])->name('people.healthStore');

    Route::get('/people/disability/{userID}', [DisabilityInfoController::class, 'create'])->name('people.disability');
    Route::post('/people/disability-store', [DisabilityInfoController::class, 'store'])->name('people.disabilityStore');

    Route::get('/people/freedom/{userID}', [FreedomFighterInfoController::class, 'create'])->name('people.freedom');
    Route::post('/people/freedom-store', [FreedomFighterInfoController::class, 'store'])->name('people.freedomStore');

    Route::get('/people/education/{userID}', [EducationalInfoController::class, 'create'])->name('people.education');
    Route::post('/people/education-store', [EducationalInfoController::class, 'store'])->name('people.educationStore');
    Route::get('/people/education-delete/{eduID}', [EducationalInfoController::class, 'destroy'])->name('people.educationDelete');

    Route::get('/people/professional/{userID}', [ProfessionalInfoController::class, 'create'])->name('people.professional');
    Route::post('/people/professional-store', [ProfessionalInfoController::class, 'store'])->name('people.professionalStore');
    Route::get('/people/professional-delete/{proID}', [ProfessionalInfoController::class, 'destroy'])->name('people.professionalDelete');

    Route::get('/people/financial/{userID}', [FinancialInfoController::class, 'create'])->name('people.financial');
    Route::post('/people/financial-store', [FinancialInfoController::class, 'store'])->name('people.financialStore');
    Route::get('/people/financial-delete/{proID}', [FinancialInfoController::class, 'destroy'])->name('people.financialDelete');

    Route::get('/people/property/{userID}', [PropertyInfoController::class, 'create'])->name('people.property');
    Route::post('/people/property-store', [PropertyInfoController::class, 'store'])->name('people.propertyStore');
    Route::get('/people/property-delete/{proID}', [PropertyInfoController::class, 'destroy'])->name('people.propertyDelete');

    // Staff Routes
    Route::resource('staff', StaffController::class);

    // Leave Application
    Route::get('leave-application/api/staff-info', [\App\Http\Controllers\Backend\LeaveApplicationController::class, 'getStaffInfo'])->name('leave-application.api.staff_info');
    Route::put('leave-application/{id}/update-status', [\App\Http\Controllers\Backend\LeaveApplicationController::class, 'updateStatus'])->name('leave-application.update-status');
    Route::resource('leave-application', \App\Http\Controllers\Backend\LeaveApplicationController::class);

    Route::get('/staff/family/{userID}', [StaffFamilyInfoController::class, 'create'])->name('staff.family');
    Route::post('/staff/family-store', [StaffFamilyInfoController::class, 'store'])->name('staff.familyStore');

    Route::get('/staff/address/{userID}', [StaffAddressInfoController::class, 'create'])->name('staff.address');
    Route::post('/staff/address-store', [StaffAddressInfoController::class, 'store'])->name('staff.addressStore');

    Route::get('/staff/health/{userID}', [StaffHealthInfoController::class, 'create'])->name('staff.health');
    Route::post('/staff/health-store', [StaffHealthInfoController::class, 'store'])->name('staff.healthStore');

    Route::get('/staff/disability/{userID}', [StaffDisabilityInfoController::class, 'create'])->name('staff.disability');
    Route::post('/staff/disability-store', [StaffDisabilityInfoController::class, 'store'])->name('staff.disabilityStore');

    Route::get('/staff/freedom/{userID}', [StaffFreedomFighterInfoController::class, 'create'])->name('staff.freedom');
    Route::post('/staff/freedom-store', [StaffFreedomFighterInfoController::class, 'store'])->name('staff.freedomStore');
    Route::get('/staff/july-figher/{userID}', [StaffFreedomFighterInfoController::class, 'julyFigher'])->name('staff.julyFigher');
    Route::post('/staff/july-figher-store', [StaffFreedomFighterInfoController::class, 'julyFigherStore'])->name('staff.julyFigherStore');

    Route::get('/staff/education/{userID}', [StaffEducationalInfoController::class, 'create'])->name('staff.education');
    Route::post('/staff/education-store', [StaffEducationalInfoController::class, 'store'])->name('staff.educationStore');
    Route::get('/staff/education-delete/{eduID}', [StaffEducationalInfoController::class, 'destroy'])->name('staff.educationDelete');

    Route::get('/staff/professional/{userID}', [StaffProfessionalInfoController::class, 'create'])->name('staff.professional');
    Route::post('/staff/professional-store', [StaffProfessionalInfoController::class, 'store'])->name('staff.professionalStore');
    Route::get('/staff/professional-delete/{proID}', [StaffProfessionalInfoController::class, 'destroy'])->name('staff.professionalDelete');

    Route::get('/staff/financial/{userID}', [StaffFinancialInfoController::class, 'create'])->name('staff.financial');
    Route::post('/staff/financial-store', [StaffFinancialInfoController::class, 'store'])->name('staff.financialStore');
    Route::get('/staff/financial-delete/{proID}', [StaffFinancialInfoController::class, 'destroy'])->name('staff.financialDelete');

    Route::get('/staff/property/{userID}', [StaffPropertyInfoController::class, 'create'])->name('staff.property');
    Route::post('/staff/property-store', [StaffPropertyInfoController::class, 'store'])->name('staff.propertyStore');
    Route::get('/staff/property-delete/{proID}', [StaffPropertyInfoController::class, 'destroy'])->name('staff.propertyDelete');

    Route::resource('certificate/citizen', CitizenCertificateController::class);
    Route::get('certificate/citizen/bn/{id}', [CitizenCertificateController::class, 'bn_certificate'])->name('citizen.bn_certificate');
    Route::resource('certificate/character', CharacterCertificateController::class);
    Route::get('certificate/character/bn/{id}', [CharacterCertificateController::class, 'bn_certificate'])->name('character.bn_certificate');

    Route::resource('certificate/death', DeathCertificateController::class);
    Route::get('certificate/death/bn/{id}', [DeathCertificateController::class, 'bn_certificate'])->name('death.bn_certificate');

    Route::resource('certificate/succession', SuccessionController::class);
    Route::get('certificate/succession/bn/{id}', [SuccessionController::class, 'bn_certificate'])->name('succession.bn_certificate');


    Route::resource('certificate/birth', BirthCertificateController::class);
    Route::resource('certificate/unmarried', UnmarriedCertificateController::class);
    Route::get('certificate/unmarried/bn/{id}', [UnmarriedCertificateController::class, 'bn_certificate'])->name('unmarried.bn_certificate');
    Route::resource('certificate/married', MarriedCertificateController::class);
    Route::get('certificate/married/bn/{id}', [MarriedCertificateController::class, 'bn_certificate'])->name('married.bn_certificate');
    Route::resource('certificate/remarried', RemarriedCertificateController::class);
    Route::get('certificate/remarried/bn/{id}', [RemarriedCertificateController::class, 'bn_certificate'])->name('remarried.bn_certificate');
    Route::resource('certificate/landless', LandlessCertificateController::class);
    Route::get('certificate/landless/bn/{id}', [LandlessCertificateController::class, 'bn_certificate'])->name('landless.bn_certificate');
    Route::resource('certificate/name', NameCertificateController::class);
    Route::get('certificate/name/bn/{id}', [NameCertificateController::class, 'bn_certificate'])->name('name.bn_certificate');
    Route::resource('certificate/income', YearlyIncomeCertificateController::class);
    Route::get('certificate/income/bn/{id}', [YearlyIncomeCertificateController::class, 'bn_certificate'])->name('income.bn_certificate');
    Route::resource('certificate/disability-certificate', DisabilityCertificateController::class);
    Route::get('certificate/disability/bn/{id}', [DisabilityCertificateController::class, 'bn_certificate'])->name('disability.bn_certificate');
    Route::resource('certificate/voter-area', VoterAreaCertificateController::class);
    Route::get('certificate/voter-area/bn/{id}', [VoterAreaCertificateController::class, 'bn_certificate'])->name('voter-area.bn_certificate');
    Route::resource('certificate/voter-list', VoterListCertificateController::class);
    Route::get('certificate/voter-list/bn/{id}', [VoterListCertificateController::class, 'bn_certificate'])->name('voter-list.bn_certificate');
    Route::resource('certificate/nid-correction', NidCorrectionCertificateController::class);
    Route::get('certificate/nid-correction/bn/{id}', [NidCorrectionCertificateController::class, 'bn_certificate'])->name('nid-correction.bn_certificate');
    Route::resource('certificate/childless', ChildlessCertificateController::class);
    Route::get('certificate/childless/bn/{id}', [ChildlessCertificateController::class, 'bn_certificate'])->name('childless.bn_certificate');

    Route::resource('certificate/orphan', OrphanCertificateController::class);
    Route::get('certificate/orphan/bn/{id}', [OrphanCertificateController::class, 'bn_certificate'])->name('orphan.bn_certificate');
    Route::resource('certificate/financial-instability', FinancialInstabilityCertificateController::class);
    Route::get('certificate/financial-instability/bn/{id}', [FinancialInstabilityCertificateController::class, 'bn_certificate'])->name('financial-instability.bn_certificate');
    Route::resource('certificate/age', AgeCertificateController::class);
    Route::get('certificate/age/bn/{id}', [AgeCertificateController::class, 'bn_certificate'])->name('age.bn_certificate');
    Route::resource('certificate/permanent-citizen', PermanentCitizenCertificateController::class);
    Route::get('certificate/permanent-citizen/bn/{id}', [PermanentCitizenCertificateController::class, 'bn_certificate'])->name('permanent-citizen.bn_certificate');
    Route::resource('certificate/residential', ResidentialCertificateController::class);
    Route::get('certificate/residential/bn/{id}', [ResidentialCertificateController::class, 'bn_certificate'])->name('residential.bn_certificate');
    Route::resource('certificate/guardian-income', GuardianCertificateController::class);
    Route::get('certificate/guardian-income/bn/{id}', [GuardianCertificateController::class, 'bn_certificate'])->name('guardian-income.bn_certificate');


    Route::prefix('basic-settings')->name('basic-settings.')->group(function () {
        Route::resource('village', VillageController::class);
        Route::resource('district', BasicDistrictController::class);
        Route::resource('thana', BasicThanaController::class);
        Route::resource('mouza', BasicMouzaController::class);
        Route::resource('upazila', BasicUpazilaController::class);
        Route::resource('union', BasicUnionController::class);
        Route::resource('pourashava', PourashavaController::class);

        Route::resource('vehicle-type', VehicleTypeController::class);
        Route::resource('vehicle-category', VehicleCategoryController::class);
        Route::resource('vehicle-subcategory', VehicleSubCategoryController::class);

        Route::resource('market-type', MarketTypeController::class);
        Route::resource('market-category', MarketCategoryController::class);
        Route::resource('market-ownership-type', MarketOwnershipTypeController::class);

        // hotel-restaurant category
        Route::resource('hotel-category', HotelCategoryController::class);
        
        // hotel-restaurant subcategory
        Route::get('hotel-subcategory/{category_id}', [HotelSubCategoryController::class, 'index'])->name('hotel-subcategory.index');
        Route::get('hotel-subcategory/create/{category_id}', [HotelSubCategoryController::class, 'create'])->name('hotel-subcategory.create');
        Route::post('hotel-subcategory/store', [HotelSubCategoryController::class, 'store'])->name('hotel-subcategory.store');
        Route::get('hotel-subcategory/show/{id}', [HotelSubCategoryController::class, 'show'])->name('hotel-subcategory.show');
        Route::get('hotel-subcategory/edit/{id}', [HotelSubCategoryController::class, 'edit'])->name('hotel-subcategory.edit');
        Route::put('hotel-subcategory/{id}', [HotelSubCategoryController::class, 'update'])->name('hotel-subcategory.update');
        Route::delete('hotel-subcategory/{id}', [HotelSubCategoryController::class, 'destroy'])->name('hotel-subcategory.destroy');

        // license category
        Route::resource('license-category', LicenseCategoryController::class);
        
        // license subcategory
        Route::get('license-subcategory/{category_id}', [LicenseSubCategoryController::class, 'index'])->name('license-subcategory.index');
        Route::get('license-subcategory/create/{category_id}', [LicenseSubCategoryController::class, 'create'])->name('license-subcategory.create');
        Route::post('license-subcategory/store', [LicenseSubCategoryController::class, 'store'])->name('license-subcategory.store');
        Route::get('license-subcategory/show/{id}', [LicenseSubCategoryController::class, 'show'])->name('license-subcategory.show');
        Route::get('license-subcategory/edit/{id}', [LicenseSubCategoryController::class, 'edit'])->name('license-subcategory.edit');
        Route::put('license-subcategory/{id}', [LicenseSubCategoryController::class, 'update'])->name('license-subcategory.update');
        Route::delete('license-subcategory/{id}', [LicenseSubCategoryController::class, 'destroy'])->name('license-subcategory.destroy');

        //Department
        Route::resource('department', DepartmentController::class);

        // Department Section
        Route::get('department-section/{department_id}', [DepartmentSectionController::class, 'index'])->name('department-section.index');
        Route::get('department-section/create/{department_id}', [DepartmentSectionController::class, 'create'])->name('department-section.create');
        Route::post('department-section/store', [DepartmentSectionController::class, 'store'])->name('department-section.store');
        Route::post('department-section/show/{id}', [DepartmentSectionController::class, 'show'])->name('department-section.show');
        Route::delete('department-section/delete/{id}', [DepartmentSectionController::class, 'destroy'])->name('department-section.destroy');
        Route::get('get-sections-by-department/{department_id}', [DepartmentSectionController::class, 'getSectionsByDepartment'])->name('get-sections-by-department');


    });

    Route::resource('license', LicenseController::class);

    // HotelRestaurantController

    Route::post('hotel-restaurant/approve', [HotelRestaurantController::class, 'approve'])->name('hotel-restaurant.approve');

    Route::post('hotel-restaurant/records', [HotelRestaurantController::class, 'records'])->name('hotel-restaurant.records');

    Route::resource('hotel-restaurant', HotelRestaurantController::class);


    // Inquiry Controller

    Route::get('/inquiry-list', [InquiryFormController::class, 'FormList'])->name('inquiry.formlist');
    Route::post('inquiry/{id}/assign', [InquiryFormController::class, 'assignDepartmentSection'])->name('inquiry.assign');
    Route::post('inquiry/{id}/receive', [InquiryFormController::class, 'receive'])->name('inquiry.receive');
    Route::resource('inquiry', InquiryFormController::class)->except(['index', 'create', 'store']);


    // ApplicationFormController

    Route::post('application-form/{id}/assign', [ApplicationFormController::class, 'assignDepartmentSection'])->name('application-form.assign');
    Route::post('application-form/{id}/receive', [ApplicationFormController::class, 'receive'])->name('application-form.receive');
    Route::post('application-form/{id}/approve', [ApplicationFormController::class, 'approve'])->name('application-form.approve');
    Route::resource('application-form', ApplicationFormController::class);


    //MisCase

    Route::post('miscase/update-date/{id}', [MisCaseController::class, 'updateNextHearingDate'])->name('miscase.updateNextHearingDate');
    Route::get('miscase/print/{id}', [MisCaseController::class, 'printCase'])->name('miscase.print');

    Route::resource('miscase', MisCaseController::class);


    // Case order
    Route::get('caseorder/{id}/print-notice', [CaseOrderController::class, 'printNotice'])->name('caseorder.printNotice');
    Route::get('caseorder/{id}/print-order', [CaseOrderController::class, 'printOrder'])->name('caseorder.printOrder');
    Route::get('caseorder-hearing-notice', [CaseOrderController::class, 'hearingNotice'])->name('caseorder.hearingNotice');
    Route::get('caseorder-date-edit', [CaseOrderController::class, 'dateEditList'])->name('caseorder.dateEditList');
    Route::post('caseorder/{id}/add-order', [CaseOrderController::class, 'addOrder'])->name('caseorder.addOrder');
    Route::get('caseorder/{mis_case_id}/register', [CaseOrderController::class, 'register'])->name('caseorder.register');
    Route::resource('caseorder', CaseOrderController::class);

    // Gun License
    Route::prefix('gun-license')->name('gun-license.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\GunLicenseController::class, 'index'])->name('index');
        Route::get('apply', [\App\Http\Controllers\Backend\GunLicenseController::class, 'create'])->name('create');

        Route::prefix('person')->name('person.')->group(function () {
            Route::get('/', [PersonGunLicenseController::class, 'index'])->name('index');
            Route::get('create', [PersonGunLicenseController::class, 'createApplication'])->name('create');
            Route::post('store', [PersonGunLicenseController::class, 'storeApplication'])->name('store');
            Route::get('{id}/verification', [PersonGunLicenseController::class, 'createVerification'])->name('verification.create');
            Route::post('{id}/verification', [PersonGunLicenseController::class, 'storeVerification'])->name('verification.store');
            Route::get('{id}/interview', [PersonGunLicenseController::class, 'createInterview'])->name('interview.create');
            Route::post('{id}/interview', [PersonGunLicenseController::class, 'storeInterview'])->name('interview.store');
            Route::post('{id}/approve', [PersonGunLicenseController::class, 'approve'])->name('approve');
            Route::post('{id}/reject', [PersonGunLicenseController::class, 'reject'])->name('reject');
            Route::get('{id}', [PersonGunLicenseController::class, 'show'])->name('show');
        });

        Route::prefix('organization')->name('org.')->group(function () {
            Route::get('/', [OrgGunLicenseController::class, 'index'])->name('index');
            Route::get('create', [OrgGunLicenseController::class, 'createApplication'])->name('create');
            Route::post('store', [OrgGunLicenseController::class, 'storeApplication'])->name('store');
            Route::get('{id}/verification', [OrgGunLicenseController::class, 'createVerification'])->name('verification.create');
            Route::post('{id}/verification', [OrgGunLicenseController::class, 'storeVerification'])->name('verification.store');
            Route::get('{id}/interview', [OrgGunLicenseController::class, 'createInterview'])->name('interview.create');
            Route::post('{id}/interview', [OrgGunLicenseController::class, 'storeInterview'])->name('interview.store');
            Route::post('{id}/approve', [OrgGunLicenseController::class, 'approve'])->name('approve');
            Route::post('{id}/reject', [OrgGunLicenseController::class, 'reject'])->name('reject');
            Route::get('{id}', [OrgGunLicenseController::class, 'show'])->name('show');
        });

        Route::prefix('other-organization')->name('other-org.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'index'])->name('index');
            Route::get('create', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'createApplication'])->name('create');
            Route::post('store', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'storeApplication'])->name('store');
            Route::get('{id}/verification', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'createVerification'])->name('verification.create');
            Route::post('{id}/verification', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'storeVerification'])->name('verification.store');
            Route::get('{id}/interview', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'createInterview'])->name('interview.create');
            Route::post('{id}/interview', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'storeInterview'])->name('interview.store');
            Route::post('{id}/approve', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'approve'])->name('approve');
            Route::post('{id}/reject', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'reject'])->name('reject');
            Route::get('{id}', [\App\Http\Controllers\Backend\OtherOrgGunLicenseController::class, 'show'])->name('show');
        });
    });
    Route::resource('chairman', ChairmanController::class);

    Route::post('/fromupdate', [ChairmanController::class, 'fromupdate'])->name('chairman.fromupdate');

    Route::controller(ChairmanController::class)->prefix('chairman')->name('chairman.')->group(function () {
        Route::post('/personalstore', 'personalstore')->name('personalstore');
        Route::post('/autocomplete/fetch', 'fetch')->name('fetch');

        // Route::get('/family/{user_id}', 'family')->name('family');
        // Route::post('/familyStore', 'familyStore')->name('familyStore');
        // Route::get('/address/{user_id}', 'address')->name('address');
        // Route::post('/addressStore', 'addressStore')->name('addressStore');
        // Route::get('/education/{user_id}', 'education')->name('education');
        // Route::post('/educationStore', 'educationStore')->name('educationStore');

        // Route::get('/professional/{user_id}', 'professional')->name('professional');
        // Route::post('/professionalStore', 'professionalStore')->name('professionalStore');
        // Route::get('/financial/{user_id}', 'financial')->name('financial');
        // Route::post('/financialStore', 'financialStore')->name('financialStore');

        // Route::get('/property/{user_id}', 'property')->name('property');
        // Route::post('/propertyStore', 'propertyStore')->name('propertyStore');

        // Route::get('/disability/{user_id}', 'disability')->name('disability');
        // Route::post('/disabilityStore', 'disabilityStore')->name('disabilityStore');

        // Route::get('/freedom/{user_id}', 'freedom')->name('freedom');
        // Route::post('/freedomStore', 'freedomStore')->name('freedomStore');

        // Route::get('/area/{user_id}', 'area')->name('area');
        // Route::post('/areaStore', 'areaStore')->name('areaStore');
    });


    Route::resource('councilor', CounsilorController::class);
    Route::controller(CounsilorController::class)->prefix('councilor')->name('councilor.')->group(function () {
        Route::post('/personalstore', 'personalstore')->name('personalstore');
        Route::get('/family/{user_id}', 'family')->name('family');
        Route::post('/familyStore', 'familyStore')->name('familyStore');
        Route::get('/address/{user_id}', 'address')->name('address');
        Route::post('/addressStore', 'addressStore')->name('addressStore');
        Route::get('/education/{user_id}', 'education')->name('education');
        Route::post('/educationStore', 'educationStore')->name('educationStore');

        Route::get('/professional/{user_id}', 'professional')->name('professional');
        Route::post('/professionalStore', 'professionalStore')->name('professionalStore');
        Route::get('/financial/{user_id}', 'financial')->name('financial');
        Route::post('/financialStore', 'financialStore')->name('financialStore');

        Route::get('/property/{user_id}', 'property')->name('property');
        Route::post('/propertyStore', 'propertyStore')->name('propertyStore');

        Route::get('/disability/{user_id}', 'disability')->name('disability');
        Route::post('/disabilityStore', 'disabilityStore')->name('disabilityStore');

        Route::get('/freedom/{user_id}', 'freedom')->name('freedom');
        Route::post('/freedomStore', 'freedomStore')->name('freedomStore');

        Route::get('/area/{user_id}', 'area')->name('area');
        Route::post('/areaStore', 'areaStore')->name('areaStore');
    });

    Route::resource('hotelRestaurant-ownership', HotelRestaurantOwnershipController::class);

    Route::controller(InventoryController::class)->prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/requisition/add-new', 'create')->name('requisition.create');
        Route::get('/requisition/list', 'index')->name('requisition.index');
        Route::get('/requisition/approve-list', 'approveList')->name('requisition.approve_list');
        Route::post('/requisition/approve', 'approveRequisition')->name('requisition.approve');
        Route::get('/receive', 'receive')->name('receive');
        Route::post('/receive', 'receiveStore')->name('receive.store');
        Route::get('/stock', 'stock')->name('stock');
        Route::get('/distribution', 'distribution')->name('distribution');
        Route::post('/distribution', 'distributionStore')->name('distribution.store');
        Route::post('/', 'store')->name('store');
        Route::post('/approve-reject', 'approveReject')->name('approve_reject');
        Route::get('/section/{step}', 'section')->whereNumber('step')->name('section');
        Route::get('/{id}/edit', 'edit')->whereNumber('id')->name('edit');
        Route::get('/{id}', 'show')->whereNumber('id')->name('show');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('destroy');
    });

    Route::controller(QuotationController::class)->prefix('inventory/quotation')->name('inventory.quotation.')->group(function () {
        Route::get('/list', 'index')->name('index');
        Route::get('/add-new', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
    });

    Route::controller(WorkOrderController::class)->prefix('inventory/work-order')->name('inventory.work-order.')->group(function () {
        Route::get('/list', 'index')->name('index');
        Route::get('/add-new', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/approve-list', 'approveList')->name('approve_list');
        Route::get('/approve-list/{id}', 'approveShow')->whereNumber('id')->name('approve_show');
        Route::post('/approve-list/update', 'updateApproved')->name('update_approved');
        Route::post('/approve', 'approveWorkOrder')->name('approve');
        Route::post('/{id}/assign-vendor', 'assignVendor')->whereNumber('id')->name('assign_vendor');
        Route::get('/{id}', 'show')->whereNumber('id')->name('show');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('destroy');
    });

    Route::controller(\App\Http\Controllers\InventoryVendorController::class)->prefix('inventory/vendors')->name('inventory.vendors.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/assigned', 'assigned')->name('assigned');
        Route::get('/assigned/{id}', 'assignedShow')->whereNumber('id')->name('assigned_show');
        Route::get('/{id}', 'show')->whereNumber('id')->name('show');
    });

    Route::controller(\App\Http\Controllers\PurchaseOrderController::class)->prefix('inventory/purchase-orders')->name('inventory.purchase_orders.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}/create', 'create')->whereNumber('id')->name('create');
        Route::post('/{id}', 'store')->whereNumber('id')->name('store');
    });

    Route::controller(\App\Http\Controllers\InventoryRepairController::class)->prefix('inventory/maintenance/repair')->name('inventory.maintenance.repair.')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/approvals', 'approvals')->name('approvals');
        Route::get('/{id}', 'show')->whereNumber('id')->name('show');
        Route::post('/{id}/status', 'updateStatus')->whereNumber('id')->name('update_status');
    });


    Route::get('organizations', function () {
        return redirect()->route('organization.index');
    });
    Route::prefix('organizations')->name('organizationA.')->group(function () {
        Route::resource('trade-license', TradeLicenseController::class);

        Route::get('trade-license/invoice/{id}', [TradeLicenseController::class, 'invoice'])->name('trade-license.invoice');
        Route::get('trade-license/preview/{id}', [TradeLicenseController::class, 'preview'])->name('trade-license.preview');
        Route::get('trade-license/confirmed/{id}', [TradeLicenseController::class, 'confirmedLicense'])->name('trade-license.confirmed');
        Route::post('trade-license/confirmation/{id}', [TradeLicenseController::class, 'licenseConfirmation'])->name('trade-license.confirmation');

        Route::get('get-trade-license', [TradeLicenseController::class, 'getTradeLicense'])->name('trade-license.getTradeLicense');



        Route::resource('registration-fees', OrganizationFeeController::class);
        Route::resource('renew-fees', OrganizationRenewController::class);
    });
    Route::post('/organization/trade-license/{id}/manual-payment/store', [TradeLicenseController::class, 'storeManualPayment'])
        ->name('organizationA.trade-license.manual-payment.store');

    Route::get('/organization/trade-license/{id}/online-payment', [TradeLicenseController::class, 'onlinePayment'])
        ->name('organizationA.trade-license.online-payment');
    Route::get('/people/approve/{id}', [PeopleController::class, 'approve'])
        ->name('people.approve');
    Route::get('/staff/approve/{id}', [StaffController::class, 'approve'])
        ->name('staff.approve');

    Route::get('peopleapprovedlist', [PeopleController::class, 'approvedlist'])
        ->name('peopleapprovedlist');
    Route::get('staffapprovedlist', [StaffController::class, 'approvedlist'])
        ->name('staffapprovedlist');


    Route::resource('institute', InstituteController::class);

    Route::prefix('institutes')->name('instituteA.')->group(function () {

        Route::get('admin/{id}', [InstituteController::class, 'admin'])->name('adminCreate');
        Route::post('admin-store', [InstituteController::class, 'adminStore'])->name('adminStore');

        Route::get('images/{id}', [InstituteController::class, 'images'])->name('imagesCreate');
        Route::post('images-store', [InstituteController::class, 'imagesStore'])->name('imagesStore');
    });

    Route::resource('institutional-admin', InstitutionalAdminController::class);


    Route::resource('admin', AdminController::class);



    Route::resource('house', HouseController::class);
    Route::resource('house-ownership', HouseOwnershipController::class);

    Route::post('land/approve', [LandController::class, 'approve'])->name('land.approve');
    Route::resource('land', LandController::class);
    Route::post('vehicle/approve', [VehicleController::class, 'approve'])->name('vehicle.approve');
    Route::get('vehicle/fees', [VehicleController::class, 'feesHub'])->name('vehicle.fees.hub');
    Route::get('vehicle/fees/setup', [VehicleController::class, 'vehicleFees'])->name('vehicle.fees.vehicle');
    Route::get('vehicle/fees/setup-list', [VehicleController::class, 'vehicleFeesList'])->name('vehicle.fees.list');
    Route::get('vehicle/fees/setup/{id}/view', [VehicleController::class, 'vehicleFeesShow'])->name('vehicle.fees.show');
    Route::get('vehicle/fees/setup/{id}/edit', [VehicleController::class, 'vehicleFeesEdit'])->name('vehicle.fees.edit');
    Route::post('vehicle/fees/setup/{id}/update', [VehicleController::class, 'updateVehicleFees'])->name('vehicle.fees.update');
    Route::post('vehicle/fees/setup', [VehicleController::class, 'storeVehicleFees'])->name('vehicle.fees.vehicle.store');
    Route::get('vehicle/api/details/{id}', [VehicleController::class, 'getDetails'])->name('vehicle.api.details');
    Route::get('vehicle/api/driver-info', [VehicleController::class, 'getDriverInfo'])->name('vehicle.api.driver_info');
    Route::resource('vehicle', VehicleController::class);
    Route::resource('vehicle-repairing', \App\Http\Controllers\VehicleRepairingController::class)->names('vehicle.repairing');
    Route::resource('vehicle-fuel', \App\Http\Controllers\VehicleFuelController::class)->names('vehicle.fuel');
    Route::resource('market', MarketController::class);
    Route::resource('bridge', BridgeController::class);
    Route::resource('road', RoadController::class);

    Route::resource('tax', TaxController::class);
    Route::post('tax-status', [TaxController::class, 'taxStatus'])->name('tax.status');

    Route::get('taxes', function () {
        return redirect()->route('tax.index');
    });

    Route::prefix('taxes')->name('taxes.')->group(function () {
        Route::resource('tax-year', TaxYearController::class);
        Route::resource('tax-rate', TaxRateController::class);
        Route::get('receipt/{id}', [TaxController::class, 'taxReceipt'])->name('receipt');
        Route::get('received', [TaxController::class, 'taxReceived'])->name('tax.received');
        Route::get('confirmed/{id}', [TaxController::class, 'taxConfirmed'])->name('confirmed');

    });


    Route::resource('marriage', MarriageController::class);
    Route::resource('divorce', DivorceController::class);

    Route::resource('institute-type', InstituteTypeController::class);
    Route::resource('institute-category', InstituteCategoryController::class);

    // Backend Appointments (inside the auth middleware group)
    Route::get('appointment-slots', [\App\Http\Controllers\Backend\AppointmentSlotController::class, 'index'])->name('appointment.slots.index');
    Route::get('appointment-slots/api', [\App\Http\Controllers\Backend\AppointmentSlotController::class, 'getSlots'])->name('appointment.slots.api');
    Route::post('appointment-slots', [\App\Http\Controllers\Backend\AppointmentSlotController::class, 'store'])->name('appointment.slots.store');
    Route::delete('appointment-slots/{id}', [\App\Http\Controllers\Backend\AppointmentSlotController::class, 'destroy'])->name('appointment.slots.destroy');

    Route::get('appointment-bookings', [\App\Http\Controllers\Backend\AppointmentBookingController::class, 'index'])->name('appointment.booking.index');
    Route::get('appointment-bookings/{id}', [\App\Http\Controllers\Backend\AppointmentBookingController::class, 'show'])->name('appointment.booking.show');
    Route::post('appointment-bookings/{id}/status', [\App\Http\Controllers\Backend\AppointmentBookingController::class, 'updateStatus'])->name('appointment.booking.updateStatus');

});

// Frontend Appointments
Route::prefix('appointments')->name('appointment.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Frontend\AppointmentController::class, 'officerList'])->name('officers');
    Route::get('/calendar/{officer_id}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'calendar'])->name('calendar');
    Route::get('/api/slots/{officer_id}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getAvailableSlots'])->name('public.slots.api');
    Route::get('/api/slots-by-date/{officer_id}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getSlotsByDate'])->name('public.slots.by_date');
    Route::get('/book/{slot_id}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'bookForm'])->name('book');
    Route::post('/book', [\App\Http\Controllers\Frontend\AppointmentController::class, 'storeBooking'])->name('store');
});
