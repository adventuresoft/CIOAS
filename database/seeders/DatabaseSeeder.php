<?php

namespace Database\Seeders;

use App\Models\BasicSettings\FamilyCategory;
use App\Models\InstituteType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PostOfficeSeeder::class,
            // DivisionSeeder::class,
            // DistrictSeeder::class,
            // ThanaSeeder::class,
            // UnionSeeder::class,
            // ReligionSeeder::class,
            // CityCorporationSeeder::class,
            // PourashavaSeeder::class,
            // CountrySeeder::class,
            // InstituteCategorySeeder::class,
            // InstituteTypeSeeder::class,
            // RoleSeeder::class,
            // UserSeeder::class,
            // BankSeeder::class,
            // AccountTypeSeeder::class,
            // MouzaSeeder::class,
            // RoadTypeSeeder::class,
            // RoadCategorySeeder::class,
            // RoadOwnerSeeder::class,
            // FamilyTypeSeeder::class,
            // FamilyCategorySeeder::class,
            // TaxYearSeeder::class,
        ]);
    }
}
