<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FamilyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id' => 1, 'en_name' => 'Joint Family', 'bn_name' => 'যৌথ পরিবার', 'slug' => 'joint-family', 'created_by' => 1, 'status' => 1],
            ['id' => 2, 'en_name' => 'Single Family', 'bn_name' => 'একক পরিবার', 'slug' => 'single-family', 'created_by' => 1, 'status' => 1]
        ];
        DB::table('family_categories')->insert($records);
    }
}
