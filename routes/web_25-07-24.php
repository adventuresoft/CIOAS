<?php

use App\Http\Controllers\AddressInfoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;

use App\Http\Controllers\BasicSettings\CityCorporationWardController;
use App\Http\Controllers\BasicSettings\FamilyCategoryController;
use App\Http\Controllers\BasicSettings\FamilySubCategoryController;
use App\Http\Controllers\BasicSettings\FamilyTypeController;
use App\Http\Controllers\BasicSettings\HouseOwnerTypeController;
use App\Http\Controllers\BasicSettings\HouseCategoryController;
use App\Http\Controllers\BasicSettings\HouseTypeController;
use App\Http\Controllers\BasicSettings\LandClassController;
use App\Http\Controllers\BasicSettings\LandOwnershipTypeController;
use App\Http\Controllers\BasicSettings\LandTypeController;
use App\Http\Controllers\BasicSettings\MarketCategoryController;
use App\Http\Controllers\BasicSettings\MarketOwnershipTypeController;
use App\Http\Controllers\BasicSettings\MarketTypeController;
use App\Http\Controllers\BasicSettings\OrganizationCategoryController;
use App\Http\Controllers\BasicSettings\OrganizationClassController;
use App\Http\Controllers\BasicSettings\OrganizationOwnershipTypeController;
use App\Http\Controllers\BasicSettings\OrganizationSubCategoryController;
use App\Http\Controllers\BasicSettings\OrganizationWorkAreaController;
use App\Http\Controllers\BasicSettings\OrganizationTypeController;
use App\Http\Controllers\BasicSettings\ProfessionCategoryController;
use App\Http\Controllers\BasicSettings\ProfessionController;
use App\Http\Controllers\BasicSettings\ProfessionSubCategoryController;
use App\Http\Controllers\BasicSettings\ProfessionTypeController;
use App\Http\Controllers\BasicSettings\ReserveWardController;
use App\Http\Controllers\BasicSettings\RoadCategoryController;
use App\Http\Controllers\BasicSettings\RoadOwnerController;
use App\Http\Controllers\BasicSettings\RoadTypeController;
use App\Http\Controllers\BasicSettings\UnionWardController;
use App\Http\Controllers\BasicSettings\VehicleCategoryController;
use App\Http\Controllers\BasicSettings\VehicleSubCategoryController;
use App\Http\Controllers\BasicSettings\VehicleTypeController;
use App\Http\Controllers\BasicSettings\VillageController;
use App\Http\Controllers\BasicSettings\VillageAreaController;
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



use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisabilityInfoController;
use App\Http\Controllers\DistrictController;
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
use App\Http\Controllers\InstitutionalAdminController;
use App\Http\Controllers\InstituteTypeController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\MarriageController;
use App\Http\Controllers\MouzaController;
use App\Http\Controllers\Organization\OrganizationController;
use App\Http\Controllers\Organization\TradeLicenseController;
use App\Http\Controllers\Organization\OrganizationFeeController;
use App\Http\Controllers\Organization\OrganizationOwnershipController;
use App\Http\Controllers\Organization\OrganizationRenewController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProfessionalInfoController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\PropertyInfoController;
use App\Http\Controllers\RoadController;
use App\Http\Controllers\Tax\TaxController;
use App\Http\Controllers\Tax\TaxRateController;
use App\Http\Controllers\Tax\TaxYearController;
use App\Http\Controllers\ThanaController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sms', function(){
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


Route::post('/load-project-type-content', [ProjectTypeController::class, 'projectTypeContent'])->name('projectTypeContent');
Route::post('/backend/load-project-type-content', [ProjectTypeController::class, 'backendProjectTypeContent'])->name('backendProjectTypeContent');

// Find Dependencies
Route::get('/get-districts-by-division/{divisionID}', [DistrictController::class, 'districtsByDivision']);
Route::get('/get-thanas-by-district/{districtID}', [ThanaController::class, 'thanasByDistrict']);
Route::get('/get-unions-by-thana/{thanaID}', [UnionController::class, 'unionsByThana']);
Route::get('/get-villages-by-union/{unionID}', [VillageController::class, 'villagesByUnion']);
Route::get('/get-mouzas-by-thana/{thanaID}', [MouzaController::class, 'mouzasByThana']);
Route::get('/get-areas-by-village/{villageID}', [VillageAreaController::class, 'areasByVillage']);
Route::get('/get-houses-by-village-area/{areaID}', [HouseController::class, 'getHouseByArea']);
Route::get('/search-user-by-system-id/{systemID}', [PeopleController::class, 'searchUser'])->name('user.searchBySystemID');
Route::get('/get-organization-info-by-system-id/{systemID}', [OrganizationController::class, 'getOrganizationBySystemId'])->name('getOrganizationBySystemId');


Route::get('/profession-type-options-by-profession/{professionID}', [ProfessionTypeController::class, 'professionTypeOptions']);
Route::get('/profession-category-options-by-profession-type/{professionTypeID}', [ProfessionCategoryController::class, 'professionCategoryOptions' ]);
Route::get('/profession-subcategory-options-by-profession-category/{professionCategoryID}', [ ProfessionSubcategoryController::class, 'professionSubcategoryOptions'  ] );

Route::get('/house-category-options-by-type-id/{type_id}', [HouseCategoryController::class, 'getCategoryOptions']);
Route::get('/house-single-ownership-form', [HouseOwnershipController::class, 'loadOwnershipForm']);
Route::get('/house-ownership-remove/{id}', [HouseOwnershipController::class, 'destroy']);

Route::get('/organization-subcategory-options/{id}', [OrganizationSubCategoryController::class, 'options']);
Route::get('/house-options/{id}', [HouseController::class, 'options']);
Route::get('/organization-work-area-options/{id}', [OrganizationWorkAreaController::class, 'options']);
Route::get('/organization-type-options/{id}', [OrganizationTypeController::class, 'options']);

Route::get('/organization-single-ownership-form', [OrganizationOwnershipController::class, 'ownershipForm']);
Route::get('/organization-ownership-remove/{id}', [OrganizationOwnershipController::class, 'destroy']);

Route::post('/get-organization-registration-fees', [OrganizationFeeController::class, "registrationFees"])->name('organization.registration.fees');
// Admin with Auth
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

    Route::resource('certificate/citizen', CitizenCertificateController::class);
    Route::get('certificate/citizen/bn/{id}', [CitizenCertificateController::class, 'bn_certificate'])->name('citizen.bn_certificate');
    Route::resource('certificate/character', CharacterCertificateController::class);
    Route::get('certificate/character/bn/{id}', [CharacterCertificateController::class, 'bn_certificate'])->name('character.bn_certificate');
    Route::resource('certificate/death', DeathCertificateController::class);
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
        Route::resource('village-area', VillageAreaController::class);
        Route::resource('village', VillageController::class);
        Route::resource('union-ward', UnionWardController::class);
        Route::resource('reserve-ward', ReserveWardController::class);
        Route::resource('city-corporation-ward', CityCorporationWardController::class);
        Route::resource('road-category', RoadCategoryController::class);
        Route::resource('road-type', RoadTypeController::class);
        Route::resource('road-owner', RoadOwnerController::class);
        
        Route::resource('profession', ProfessionController::class);
        Route::resource('profession-category', ProfessionCategoryController::class);
        Route::resource('profession-subcategory', ProfessionSubCategoryController::class);
        Route::resource('profession-type', ProfessionTypeController::class);

        Route::resource('land-type', LandTypeController::class);
        Route::resource('land-class', LandClassController::class);
        Route::resource('land-ownership-type', LandOwnershipTypeController::class);

        Route::resource('house-ownership-type', HouseOwnerTypeController::class );
        Route::resource('house-type', HouseTypeController::class);
        Route::resource('house-category', HouseCategoryController::class);

        Route::resource('organization-ownership-type', OrganizationOwnershipTypeController::class);
        Route::resource('organization-category', OrganizationCategoryController::class);
        Route::resource('organization-subcategory', OrganizationSubCategoryController::class);
        Route::resource('organization-work-area', OrganizationWorkAreaController::class);

        Route::resource('organization-type', OrganizationTypeController::class);


        Route::resource('family-category', FamilyCategoryController::class);
        Route::resource('family-subcategory', FamilySubCategoryController::class);
        Route::resource('family-type', FamilyTypeController::class);

        Route::resource('vehicle-type', VehicleTypeController::class);
        Route::resource('vehicle-category', VehicleCategoryController::class);
        Route::resource('vehicle-subcategory', VehicleSubCategoryController::class);

        Route::resource('market-type', MarketTypeController::class);
        Route::resource('market-category', MarketCategoryController::class);
        Route::resource('market-ownership-type', MarketOwnershipTypeController::class);
    });

    Route::resource('organization', OrganizationController::class);
    Route::resource('organization-ownership', OrganizationOwnershipController::class);

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

    Route::resource('land', LandController::class);
    Route::resource('vehicle', VehicleController::class);
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



});
