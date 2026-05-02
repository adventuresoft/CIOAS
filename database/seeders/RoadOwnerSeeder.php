<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoadOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'en_name' => 'Private', 'bn_name' => 'ব্যক্তিগত', 'slug' => 'private', 'created_by' => 1, 'status' => 1],
            ['id' => 2, 'en_name' => 'LGED', 'bn_name' => 'স্থানীয় সরকার', 'slug' => 'lged', 'created_by' => 1, 'status' => 1],
            ['id' => 3, 'en_name' => 'Roads & Hiway Department', 'bn_name' => 'সড়ক ও মহাসড়ক অধিদপ্তর', 'slug' => 'roads-hiway-department', 'created_by' => 1, 'status' => 1]
        ];

        DB::table('road_owners')->insert($data);
    }
}
