<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id' => 1, 'name' => 'Admin', 'slug' => 'admin', 'description' => 'Admin', 'status' => true, 'created_by' => 1],
            ['id' => 2, 'name' => 'DC', 'slug' => 'dc', 'description' => 'DC', 'status' => true, 'created_by' => 1],
            ['id' => 3, 'name' => 'ENO', 'slug' => 'eno', 'description' => 'ENO', 'status' => true, 'created_by' => 1],
            ['id' => 4, 'name' => 'Developer', 'slug' => 'developer', 'description' => 'Developer', 'status' => true, 'created_by' => 1],
            ['id' => 5, 'name' => 'User', 'slug' => 'user', 'description' => 'User', 'status' => true, 'created_by' => 1],
            ['id' => 6, 'name' => 'Union Admin', 'slug' => 'union-admin', 'description' => 'Union Admin', 'status' => true, 'created_by' => 1],
            ['id' => 7, 'name' => 'Union User', 'slug' => 'union-user', 'description' => 'Union User', 'status' => true, 'created_by' => 1],
            ['id' => 8, 'name' => 'Pourashava Admin', 'slug' => 'pourashava-admin', 'description' => 'Pourashava Admin', 'status' => true, 'created_by' => 1],
            ['id' => 9, 'name' => 'Pourashava User', 'slug' => 'pourashava-user', 'description' => 'Pourashava User', 'status' => true, 'created_by' => 1],
            ['id' => 10, 'name' => 'City Corporation Admin', 'slug' => 'city-corporation-admin', 'description' => 'City Corporation Admin', 'status' => true, 'created_by' => 1],
            ['id' => 11, 'name' => 'City Corporation User', 'slug' => 'city-corporation-user', 'description' => 'City Corporation User', 'status' => true, 'created_by' => 1],
        ];
        DB::table('roles')->insert($records);
    }
}
