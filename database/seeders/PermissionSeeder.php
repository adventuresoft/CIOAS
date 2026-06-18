<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Standard actions for every module
        $actions = [ 'read', 'create', 'update', 'delete' ];

        // Comprehensive module list from sidebar/web.php
        $modules = [
            'basic_settings',
            'institutional_admin',
            'certificate',
            'certificates',
            'bridge',
            'bridges',
            'market',
            'markets',
            'people',
            'dashboard',
            'city_corporation',
            'city_corporation_ward',
            'family_category',
            'family_subcategory',
            'family_type',
            'house_ownership_type',
            'house_type',
            'house_category',
            'land_type',
            'land_class',
            'land_ownership_type',
            'organization_category',
            'organization_subcategory',
            'organization_work_area',
            'organization_type',
            'profession',
            'professions',
            'profession_category',
            'profession_subcategory',
            'profession_type',
            'road_category',
            'road_type',
            'road_owner',
            'vehicle_category',
            'vehicle_subcategory',
            'vehicle_type',
            'union_ward',
            'village',
            'villages',
            'district',
            'districts',
            'thana',
            'thanas',
            'upazila',
            'upazilas',
            'mouza',
            'mouzas',
            'village_area',
            'union',
            'unions',
            'institute',
            'institutions',
            'institute_category',
            'institute_type',
            'age_certificate',
            'character_certificate',
            'childless_certificate',
            'citizen_certificate',
            'disability_certificate',
            'financial_instability_certificate',
            'guardian_certificate',
            'landless_certificate',
            'married_certificate',
            'name_certificate',
            'nid_correction_certificate',
            'orphan_certificate',
            'permanent_citizen_certificate',
            'remarried_certificate',
            'residential_certificate',
            'unmarried_certificate',
            'voter_area_certificate',
            'voter_list_certificate',
            'yearly_income_certificate',
            'organization',
            'organizations',
            'trade_license',
            'trades',
            'tax',
            'taxes',
            'house',
            'houses',
            'land',
            'lands',
            'vehicle',
            'vehicles',
            'road',
            'roads',
            'marriage',
            'marriages',
            'divorce',
            'divorces',
            'chairman',
            'councilor',
            'role',
            'roles',
            'permission',
            'permissions',
            'user',
            'users',
            'staff',
            'staffs',
            'hotel_category',
            'hotel_subcategory',
            'hotel_restaurant',
            'hotel_restaurant_ownership',
            'license',
            'licenses',
            'license_category',
            'license_subcategory',
            'department',
            'departments',
            'department_section',
            'sections',
            'application_form',
            'organization_ownership',
            'house_ownership',
            'registration_fees',
            'renew_fees',
            'reserve_ward',
            'market_type',
            'market_category',
            'market_ownership_type'
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissionName = $module . '.' . $action;
                Permission::firstOrCreate([
                    'name'       => $permissionName,
                    'guard_name' => 'web'
                ]);
            }
        }

        // Assign all permissions to Superadmin (Role 1) and Developer (Role 4)
        $superAdminRole = Role::find(1);
        $developerRole  = Role::find(4);

        if ($superAdminRole) {
            $allPermissions = Permission::all();
            $superAdminRole->syncPermissions($allPermissions);
        }

        if ($developerRole) {
            $allPermissions = Permission::all();
            $developerRole->syncPermissions($allPermissions);
        }
    }
}
