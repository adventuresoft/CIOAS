<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoadCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'en_name' => 'Soiling', 'bn_name' => 'কাঁচা', 'slug' => 'soiling', 'created_by' => 1, 'status' => 1],
            ['id' => 2, 'en_name' => 'Brick Soling', 'bn_name' => 'ইটের সলিং', 'slug' => 'brick-soling', 'created_by' => 1, 'status' => 1],
            ['id' => 3, 'en_name' => 'Carpeting', 'bn_name' => 'পাকা', 'slug' => 'carpeting', 'created_by' => 1, 'status' => 1]
        ];

        DB::table('road_categories')->insert($data);
    }
}
