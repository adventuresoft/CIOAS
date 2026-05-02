<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id' => 1, 'en_name' => 'Family Head', 'bn_name' => 'পরিবারের প্রধান', 'slug' => 'family-head', 'created_by' => 1, 'status' => 1],
            ['id' => 2, 'en_name' => 'Family Member', 'bn_name' => 'পরিবারের সদস্য', 'slug' => 'family-member', 'created_by' => 1, 'status' => 1]
        ];
        DB::table('family_types')->insert($records);
    }
}
