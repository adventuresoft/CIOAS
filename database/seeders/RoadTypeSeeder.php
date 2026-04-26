<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'en_name' => 'Local Highway', 'bn_name' => 'স্থানীয় মহাসড়ক', 'slug' => 'local-highway', 'status' => 1, 'created_by' => 1 ],
            ['id' => 2, 'en_name' => 'National Highway', 'bn_name' => 'জাতীয় মহাসড়ক', 'slug' => 'national-highway', 'status' => 1, 'created_by' => 1 ],
            ['id' => 3, 'en_name' => 'Local Road', 'bn_name' => 'স্থানীয় সড়ক', 'slug' => 'local-road', 'status' => 1, 'created_by' => 1 ]
        ];

        DB::table('road_types')->insert($data);
    }
}
