<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id' => 1, 'name' => 'Islam', 'slug' => 'islam', 'status' => true, 'created_by' => 1],
            ['id' => 2, 'name' => 'Hindu ', 'slug' => 'Hindu', 'status' => true, 'created_by' => 1],
            ['id' => 3, 'name' => 'Buddhist', 'slug' => 'Buddhist ', 'status' => true, 'created_by' => 1],
            ['id' => 4, 'name' => 'Christian', 'slug' => 'Christian', 'status' => true, 'created_by' => 1],
            ['id' => 5, 'name' => 'Others', 'slug' => 'others', 'status' => true, 'created_by' => 1],
        ];
        DB::table('religions')->insert($records);
    }
}
