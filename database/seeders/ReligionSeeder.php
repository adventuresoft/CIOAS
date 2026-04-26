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
            ['id' => 1, 'name' => 'Muslim ','slug' => 'muslim', 'status' => true, 'created_by' => 1],
            ['id' => 2, 'name' => 'Hinduism ', 'slug' => 'hinduism', 'status' => true, 'created_by' => 1],
            ['id' => 3, 'name' => 'Buddhism', 'slug' => 'buddhism ', 'status' => true, 'created_by' => 1],
            ['id' => 4, 'name' => 'Christianity', 'slug' => 'christianity', 'status' => true, 'created_by' => 1],
            ['id' => 5, 'name' => 'Others', 'slug' => 'others', 'status' => true, 'created_by' => 1],
        ];
        DB::table('religions')->insert($records);
    }
}
